<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Kolom untuk fitur admin:
 * - users.is_verified          : 1 = aktif, 0 = mentor menunggu verifikasi admin.
 *                                Akun yang sudah ada otomatis bernilai 1.
 * - mahasiswa_profiles.mentor_id : pembimbing (users.id milik mentor). NULL = belum ada.
 *
 * Jalankan: php spark migrate
 */
class AdminFeatures extends Migration
{
    /**
     * Tipe lebih spesifik agar editor (Intelephense) mengenali method seperti
     * fieldExists() dan protectIdentifiers(). Tidak mengubah perilaku.
     *
     * @var \CodeIgniter\Database\BaseConnection
     */
    protected $db;

    public function up()
    {
        if (! $this->db->fieldExists('is_verified', 'users')) {
            $this->forge->addColumn('users', [
                'is_verified' => [
                    'type'       => 'TINYINT',
                    'constraint' => 1,
                    'null'       => false,
                    'default'    => 1,
                    'after'      => 'role',
                ],
            ]);
        }

        if (! $this->db->fieldExists('mentor_id', 'mahasiswa_profiles')) {
            // Tipe mentor_id disamakan persis dengan users.id agar foreign key bisa dibuat
            $idUsers = $this->db->query(
                'SHOW COLUMNS FROM ' . $this->tabel('users') . ' LIKE ' . $this->db->escape('id')
            )->getRowArray();
            $tipe = $idUsers['Type'] ?? 'int(11) unsigned';

            $this->db->query(sprintf(
                'ALTER TABLE %s ADD %s %s NULL DEFAULT NULL AFTER %s',
                $this->tabel('mahasiswa_profiles'),
                $this->db->escapeIdentifiers('mentor_id'),
                $tipe,
                $this->db->escapeIdentifiers('user_id')
            ));

            $this->db->query(sprintf(
                'ALTER TABLE %s ADD CONSTRAINT %s FOREIGN KEY (%s) REFERENCES %s (%s) ON DELETE SET NULL ON UPDATE CASCADE',
                $this->tabel('mahasiswa_profiles'),
                $this->db->escapeIdentifiers('mahasiswa_profiles_mentor_id_foreign'),
                $this->db->escapeIdentifiers('mentor_id'),
                $this->tabel('users'),
                $this->db->escapeIdentifiers('id')
            ));
        }
    }

    public function down()
    {
        if ($this->db->fieldExists('mentor_id', 'mahasiswa_profiles')) {
            $this->db->query(sprintf(
                'ALTER TABLE %s DROP FOREIGN KEY %s',
                $this->tabel('mahasiswa_profiles'),
                $this->db->escapeIdentifiers('mahasiswa_profiles_mentor_id_foreign')
            ));
            $this->forge->dropColumn('mahasiswa_profiles', 'mentor_id');
        }

        if ($this->db->fieldExists('is_verified', 'users')) {
            $this->forge->dropColumn('users', 'is_verified');
        }
    }

    private function tabel(string $nama): string
    {
        return $this->db->protectIdentifiers($nama, true);
    }
}