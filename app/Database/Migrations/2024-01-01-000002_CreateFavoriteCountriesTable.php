<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Migration: CreateFavoriteCountriesTable
 * Membuat tabel favorite_countries untuk menyimpan negara favorit/wishlist.
 */
class CreateFavoriteCountriesTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_negara' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'official_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'flag' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'region' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'subregion' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'capital' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'population' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
                'null'     => true,
            ],
            'languages' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'currencies' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'timezones' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'maps_url' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status_wishlist' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
                'default'    => 'Wishlist',
            ],
            'catatan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'tanggal_ditambahkan' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('favorite_countries');
    }

    public function down(): void
    {
        $this->forge->dropTable('favorite_countries');
    }
}
