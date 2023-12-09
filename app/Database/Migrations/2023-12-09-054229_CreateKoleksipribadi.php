<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKoleksipribadi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'KoleksiID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'UserID' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 11,
            ],
            'BukuID' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('KoleksiID', true);
        $this->forge->createTable('koleksipribadi');
    }

    public function down()
    {
        $this->forge->dropTable('koleksipribadi');
    }
}
