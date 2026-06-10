<?php

namespace App\Models;

use CodeIgniter\Model;

class ManagedCountryModel extends Model
{
    protected $table = 'managed_countries';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;

    protected $allowedFields = [
        'name',
        'official_name',
        'code',
        'flag_url',
        'capital',
        'region',
        'subregion',
        'population',
        'languages',
        'currencies',
        'timezones',
        'maps_url',
        'description',
        'is_published',
    ];

    protected $validationRules = [
        'name'         => 'required|max_length[100]',
        'official_name'=> 'permit_empty|max_length[150]',
        'code'         => 'permit_empty|max_length[3]',
        'flag_url'     => 'permit_empty|valid_url_strict',
        'maps_url'     => 'permit_empty|valid_url_strict',
        'population'   => 'permit_empty|is_natural',
        'is_published' => 'required|in_list[0,1]',
    ];

    public function published(): array
    {
        return $this->where('is_published', 1)->orderBy('name', 'ASC')->findAll();
    }

    public function findByName(string $name): ?array
    {
        return $this->where('name', $name)->first();
    }

    public function toApiShape(array $country): array
    {
        return [
            '_managed_id' => (int) $country['id'],
            'name' => [
                'common'   => $country['name'],
                'official' => $country['official_name'] ?: $country['name'],
            ],
            'cca3'       => strtoupper($country['code'] ?? ''),
            'flags'      => ['svg' => $country['flag_url'] ?? '', 'png' => $country['flag_url'] ?? ''],
            'capital'    => $country['capital'] ? [$country['capital']] : [],
            'region'     => $country['region'] ?? '',
            'subregion'  => $country['subregion'] ?? '',
            'population' => (int) ($country['population'] ?? 0),
            'languages'  => $this->listToMap($country['languages'] ?? ''),
            'currencies' => $this->currenciesToMap($country['currencies'] ?? ''),
            'timezones'  => $this->csvList($country['timezones'] ?? ''),
            'maps'       => ['googleMaps' => $country['maps_url'] ?? ''],
            'description'=> $country['description'] ?? '',
        ];
    }

    private function csvList(string $value): array
    {
        return array_values(array_filter(array_map('trim', explode(',', $value))));
    }

    private function listToMap(string $value): array
    {
        $result = [];
        foreach ($this->csvList($value) as $index => $item) {
            $result['lang_' . $index] = $item;
        }

        return $result;
    }

    private function currenciesToMap(string $value): array
    {
        $result = [];
        foreach ($this->csvList($value) as $index => $item) {
            $result['CUR' . $index] = ['name' => $item, 'symbol' => '-'];
        }

        return $result;
    }
}
