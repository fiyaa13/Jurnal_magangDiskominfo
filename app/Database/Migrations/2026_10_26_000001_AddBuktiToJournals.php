<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Menambah kolom `bukti` (nama file foto bukti kegiatan) ke tabel journals.
 * Jalankan: php spark migrate
 */
class AddBuktiToJournals extends Migration
{
    public function up()
    {
        $this->forge->addColumn('journals', [
            'bukti' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'deskripsi',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('journals', 'bukti');
    }
}
