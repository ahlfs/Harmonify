<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FotoAlbum extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'FotoAlbumID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'FotoID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'UserID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'AlbumID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('FotoAlbumID', true);
        $this->forge->createTable('fotoalbum');
    }

    public function down()
    {
        $this->forge->dropTable('fotoalbum');
    }
}
