<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Album extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'AlbumID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'NamaAlbum' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'DeskripsiAlbum' => [
                'type' => 'TEXT',
            ],
            'TanggalAlbum' => [
                'type' => 'DATE',
            ],
            'UserID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('AlbumID', true);
        $this->forge->createTable('album');
    }

    public function down()
    {
        $this->forge->dropTable('album');
    }
}
