<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateManagedCountriesTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'name'          => ['type' => 'VARCHAR', 'constraint' => 100],
            'official_name' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'code'          => ['type' => 'VARCHAR', 'constraint' => 3, 'null' => true],
            'flag_url'      => ['type' => 'TEXT', 'null' => true],
            'capital'       => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'region'        => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'subregion'     => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'population'    => ['type' => 'BIGINT', 'unsigned' => true, 'default' => 0],
            'languages'     => ['type' => 'TEXT', 'null' => true],
            'currencies'    => ['type' => 'TEXT', 'null' => true],
            'timezones'     => ['type' => 'TEXT', 'null' => true],
            'maps_url'      => ['type' => 'TEXT', 'null' => true],
            'description'   => ['type' => 'TEXT', 'null' => true],
            'is_published'  => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('name');
        $this->forge->createTable('managed_countries');
    }

    public function down(): void
    {
        $this->forge->dropTable('managed_countries');
    }
}
