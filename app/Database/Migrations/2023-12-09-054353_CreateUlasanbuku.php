<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUlasanbuku extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'UlasanID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'UserID' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'BukuID' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'Ulasan' => [
                'type' => 'TEXT',
            ],
            'Rating' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('UlasanID', true);
        $this->forge->createTable('ulasanbuku');
    }

    public function down()
    {
        $this->forge->dropTable('ulasanbuku');
    }
}
