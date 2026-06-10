<?php

namespace App\Libraries;

use RuntimeException;

class CountryApiService
{
    private const CACHE_TTL = 21600;
    private const BACKUP_CACHE_TTL = 604800;

    public function getAll(string $url, bool $refresh = false): array
    {
        $cache = cache();
        $cacheKey = 'country_list_' . md5($url);
        $backupCacheKey = $cacheKey . '_backup';

        if (! $refresh) {
            $cached = $cache->get($cacheKey);
            if (is_array($cached) && $cached !== []) {
                return $cached;
            }
        }

        try {
            $response = \Config\Services::curlrequest()->request('GET', $url, [
                'connect_timeout' => 8,
                'timeout'         => 45,
                'verify'          => false,
            ]);

            if ($response->getStatusCode() !== 200) {
                throw new RuntimeException('API merespons dengan status ' . $response->getStatusCode());
            }

            $countries = json_decode($response->getBody(), true);
            if (! is_array($countries)) {
                throw new RuntimeException('Format data API tidak valid.');
            }

            usort($countries, static fn (array $a, array $b): int =>
                strcmp($a['name']['common'] ?? '', $b['name']['common'] ?? '')
            );

            $cache->save($cacheKey, $countries, self::CACHE_TTL);
            $cache->save($backupCacheKey, $countries, self::BACKUP_CACHE_TTL);

            return $countries;
        } catch (\Throwable $exception) {
            $backup = $cache->get($backupCacheKey);
            if (is_array($backup) && $backup !== []) {
                log_message('warning', 'REST Countries API gagal, memakai cache cadangan: ' . $exception->getMessage());

                return $backup;
            }

            throw $exception;
        }
    }

    public function getDetail(string $url, bool $refresh = false): ?array
    {
        $cache = cache();
        $cacheKey = 'country_detail_' . md5($url);

        if (! $refresh) {
            $cached = $cache->get($cacheKey);
            if (is_array($cached) && $cached !== []) {
                return $cached;
            }
        }

        $response = \Config\Services::curlrequest()->request('GET', $url, [
            'connect_timeout' => 4,
            'timeout'         => 12,
            'verify'          => false,
        ]);

        if ($response->getStatusCode() !== 200) {
            return null;
        }

        $result = json_decode($response->getBody(), true);
        $country = is_array($result) ? ($result[0] ?? null) : null;

        if (is_array($country) && $country !== []) {
            $cache->save($cacheKey, $country, self::CACHE_TTL);
        }

        return $country;
    }
}
