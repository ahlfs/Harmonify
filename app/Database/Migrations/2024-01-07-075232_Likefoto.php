<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Likefoto extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'LikeID' => [
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
            'TanggalLike' => [
                'type' => 'DATE',
            ],
        ]);
        $this->forge->addKey('LikeID', true);
        $this->forge->createTable('likefoto');
    }

    public function down()
    {
        $this->forge->dropTable('likefoto');
    }
}
