<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBuku extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'BukuID' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'Judul' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'Penulis' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'Penerbit' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'TahunTerbit' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('BukuID', true);
        $this->forge->createTable('buku');
    }

    public function down()
    {
        $this->forge->dropTable('buku');
    }
}
