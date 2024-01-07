<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Komentarfoto extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'KomentarID' => [
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
            'IsiKomentar' => [
                'type' => 'TEXT',
            ],
            'TanggalKomentar' => [
                'type' => 'DATE',
            ],
        ]);
        $this->forge->addKey('KomentarID', true);
        $this->forge->createTable('komentarfoto');
    }

    public function down()
    {
        $this->forge->dropTable('komentarfoto');
    }
}
