<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Foto extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'FotoID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'JudulFoto' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'DeskripsiFoto' => [
                'type' => 'TEXT',
            ],
            'TanggalUnggah' => [
                'type' => 'DATE',
            ],
            'LokasiFile' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'AlbumID' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'UserID' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'Url' => [
                'type' => 'TEXT',
            ],
            'Foto' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addKey('FotoID', true);
        $this->forge->createTable('foto');
    }

    public function down()
    {
        $this->forge->dropTable('foto');
    }
}
