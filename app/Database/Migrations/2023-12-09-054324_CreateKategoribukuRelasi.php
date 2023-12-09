<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKategoribukuRelasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'KategoriBukuID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'BukuID' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'KategoriID' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('KategoriBukuID', true);
        $this->forge->createTable('kategoribuku_relasi');
    }

    public function down()
    {
        $this->forge->dropTable('kategoribuku_relasi');
    }
}
