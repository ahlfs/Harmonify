<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKategoribuku extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'KategoriID' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'NamaKategori' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addKey('KategoriID', true);
        $this->forge->createTable('kategoribuku');
    }

    public function down()
    {
        $this->forge->dropTable('kategoribuku');
    }
}
