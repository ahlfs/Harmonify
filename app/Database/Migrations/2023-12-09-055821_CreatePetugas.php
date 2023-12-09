<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePetugas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'PetugasID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'Username' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'Password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'Email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'NamaLengkap' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'NoTelp' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'Alamat' => [
                'type' => 'TEXT',
            ],
            'Foto' => [
                'type' => 'BLOB',
            ],
            'Level' => [
                'type' => 'ENUM',
                'constraint' => ['petugas', 'admin'],
                'default' => 'petugas',
            ],
        ]);
        $this->forge->addKey('PetugasID', true);
        $this->forge->createTable('petugas');
    }

    public function down()
    {
        $this->forge->dropTable('petugas');
    }
}
