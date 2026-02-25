<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJournals extends Migration
{
    public function up()
{
    $this->forge->addField([
        'id' => [
            'type' => 'INT',
            'auto_increment' => true
        ],
        'user_id' => [
            'type' => 'INT'
        ],
        'minggu' => [
            'type' => 'INT'
        ],
        'tanggal' => [
            'type' => 'DATE'
        ],
        'hari' => [
            'type' => 'ENUM',
            'constraint' => ['Senin','Selasa','Rabu','Kamis','Jumat']
        ],
        'deskripsi' => [
            'type' => 'TEXT'
        ],
        'status' => [
            'type' => 'ENUM',
            'constraint' => ['pending','disetujui'],
            'default' => 'pending'
        ],
        'mentor_note' => [
            'type' => 'TEXT',
            'null' => true
        ]
    ]);

    $this->forge->addKey('id', true);
    $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
    $this->forge->createTable('journals');
}
public function down()
{
    $this->forge->dropTable('journals');
}

}
