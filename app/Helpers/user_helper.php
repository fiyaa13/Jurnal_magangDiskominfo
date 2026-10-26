<?php

if (! function_exists('name_initials')) {
    /**
     * Inisial dari dua kata pertama nama. "Luthfi Hapsari" -> "LH".
     */
    function name_initials(?string $name): string
    {
        $words    = preg_split('/\s+/', trim((string) $name), -1, PREG_SPLIT_NO_EMPTY);
        $initials = mb_strtoupper(implode('', array_map(
            static fn ($w) => mb_substr($w, 0, 1),
            array_slice($words, 0, 2)
        )));

        return $initials !== '' ? $initials : '?';
    }
}

if (! function_exists('current_user_display')) {
    /**
     * Nama tampilan dan inisial user yang sedang login.
     * Dipakai di topbar dan sidebar supaya hasilnya selalu sama.
     *
     * @return array{name: string, initials: string}
     */
    function current_user_display(): array
    {
        $name = trim((string) (session()->get('name') ?? ''));

        return [
            'name'     => $name !== '' ? $name : '—',
            'initials' => name_initials($name),
        ];
    }
}
