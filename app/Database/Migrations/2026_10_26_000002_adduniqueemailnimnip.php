<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Menjamin email, NIM, dan NIP tidak bisa dipakai dua kali,
 * langsung di level database (lapis kedua setelah validasi di Auth.php).
 *
 * Syarat: tidak boleh ada data ganda saat migration dijalankan.
 * Jalankan: php spark migrate
 */
class AddUniqueEmailNimNip extends Migration
{
    /**
     * Tipe lebih spesifik agar editor (Intelephense) mengenali method seperti
     * fieldExists() dan protectIdentifiers(). Tidak mengubah perilaku.
     *
     * @var \CodeIgniter\Database\BaseConnection
     */
    protected $db;

    private array $indexes = [
        'users'              => ['users_email_unique', 'email'],
        'mahasiswa_profiles' => ['mahasiswa_profiles_nim_unique', 'nim'],
        'mentor_profiles'    => ['mentor_profiles_nip_unique', 'nip'],
    ];

    public function up()
    {
        foreach ($this->indexes as $table => [$name, $column]) {
            $this->db->query(sprintf(
                'ALTER TABLE %s ADD UNIQUE KEY %s (%s)',
                $this->db->protectIdentifiers($table, true),
                $this->db->escapeIdentifiers($name),
                $this->db->escapeIdentifiers($column)
            ));
        }
    }

    public function down()
    {
        foreach ($this->indexes as $table => [$name]) {
            $this->db->query(sprintf(
                'ALTER TABLE %s DROP INDEX %s',
                $this->db->protectIdentifiers($table, true),
                $this->db->escapeIdentifiers($name)
            ));
        }
    }
}