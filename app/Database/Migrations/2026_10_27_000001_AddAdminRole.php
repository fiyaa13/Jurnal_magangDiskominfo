<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Menambahkan nilai 'admin' ke kolom users.role.
 *
 * - Jika kolom role bertipe ENUM (mis. ENUM('mahasiswa','mentor')),
 *   nilai 'admin' ditambahkan ke daftar ENUM.
 * - Jika bertipe VARCHAR, tidak ada yang perlu diubah (migration dilewati).
 *
 * Jalankan: php spark migrate
 */
class AddAdminRole extends Migration
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
        $kolom = $this->kolomRole();

        if ($kolom === null || ! str_starts_with(strtolower($kolom['Type']), 'enum(')) {
            return; // bukan ENUM → 'admin' sudah bisa disimpan
        }

        $nilai = $this->nilaiEnum($kolom['Type']);

        if (in_array('admin', $nilai, true)) {
            return; // sudah ada
        }

        $nilai[] = 'admin';
        $this->ubahEnum($nilai, $kolom);
    }

    public function down()
    {
        $kolom = $this->kolomRole();

        if ($kolom === null || ! str_starts_with(strtolower($kolom['Type']), 'enum(')) {
            return;
        }

        // Jangan hapus 'admin' dari ENUM selama masih ada akun admin
        if ($this->db->table('users')->where('role', 'admin')->countAllResults() > 0) {
            return;
        }

        $nilai = array_values(array_diff($this->nilaiEnum($kolom['Type']), ['admin']));
        $this->ubahEnum($nilai, $kolom);
    }

    /** Info kolom role dari SHOW COLUMNS (Type, Null, Default). */
    private function kolomRole(): ?array
    {
        $baris = $this->db->query(
            'SHOW COLUMNS FROM ' . $this->db->protectIdentifiers('users', true) . ' LIKE ' . $this->db->escape('role')
        )->getRowArray();

        return $baris ?: null;
    }

    /** "enum('mahasiswa','mentor')" → ['mahasiswa', 'mentor'] */
    private function nilaiEnum(string $type): array
    {
        preg_match_all("/'((?:[^'\\\\]|\\\\.|'')*)'/", $type, $m);

        return array_map(static fn ($v) => str_replace("''", "'", $v), $m[1]);
    }

    private function ubahEnum(array $nilai, array $kolom): void
    {
        $daftar  = implode(',', array_map(fn ($v) => $this->db->escape($v), $nilai));
        $null    = strtoupper($kolom['Null']) === 'YES' ? 'NULL' : 'NOT NULL';
        $default = $kolom['Default'] !== null ? ' DEFAULT ' . $this->db->escape($kolom['Default']) : '';

        $this->db->query(sprintf(
            'ALTER TABLE %s MODIFY %s ENUM(%s) %s%s',
            $this->db->protectIdentifiers('users', true),
            $this->db->escapeIdentifiers('role'),
            $daftar,
            $null,
            $default
        ));
    }
}