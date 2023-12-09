<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePeminjaman extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'PeminjamanID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'UserID' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'BukuID' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'TanggalPeminjaman' => [
                'type' => 'DATE',
            ],
            'TanggalPengembalian' => [
                'type' => 'DATE',
            ],
            'StatusPeminjaman' => [
                'type' => 'ENUM',
                'constraint' => ['pinjam', 'kembali'],
                'default' => 'pinjam',
            ],
        ]);
        $this->forge->addKey('PeminjamanID', true);
        $this->forge->createTable('peminjaman');
    }

    public function down()
    {
        $this->forge->dropTable('peminjaman');
    }
}
