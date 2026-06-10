<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * ApiSettingSeeder
 * Mengisi data default konfigurasi REST Countries API.
 */
class ApiSettingSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_api'   => 'REST Countries API',
                'base_url'   => 'https://restcountries.com/v3.1/all?fields=name,flags,capital,region,subregion,population,cca3',
                'method'     => 'GET',
                'api_key'    => null,
                'auth_header'=> null,
                'status'     => 'Aktif',
                'last_sync'  => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('api_settings')->insertBatch($data);

        echo "ApiSettingSeeder: Data default REST Countries API berhasil ditambahkan.\n";
    }
}
