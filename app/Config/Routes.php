<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ROOT
$routes->get('/', function () {
    if (session()->get('logged_in')) {
        return redirect()->to('/dashboard');
    }
    return redirect()->to('/login');
});

// =======================
// AUTH
// =======================

// LOGIN
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::process');

// REGISTRASI (PILIH)
$routes->get('register', function () {
    return view('auth/register_choice');
});

// REGISTRASI MAHASISWA
$routes->get('register/mahasiswa', 'Auth::registerMahasiswa');
$routes->post('register/mahasiswa', 'Auth::saveMahasiswa');

// REGISTRASI MENTOR
$routes->get('register/mentor', 'Auth::registerMentor');
$routes->post('register/mentor', 'Auth::saveMentor');

// LOGOUT
$routes->get('logout', 'Auth::logout');

// =======================
// DASHBOARD
// =======================
$routes->get('dashboard', 'DashboardController::index', ['filter' => 'auth']);

// =======================
// FOTO BUKTI JURNAL
// Di luar grup 'journal' karena grup itu khusus mahasiswa, sedangkan
// mentor juga perlu melihat foto. Hak akses dicek di JournalController::bukti()
// (hanya mentor dan mahasiswa pemilik jurnal).
// =======================
$routes->get('journal/bukti/(:num)', 'JournalController::bukti/$1', ['filter' => 'auth']);

// =======================
// JOURNAL (MAHASISWA)
// =======================
$routes->group('journal', ['filter' => ['auth', 'role:mahasiswa']], function ($routes) {
    $routes->get('/', 'JournalController::index');

    $routes->get('create', 'JournalController::create');
    $routes->post('store', 'JournalController::store');

    $routes->get('edit/(:num)', 'JournalController::edit/$1');
    $routes->post('update/(:num)', 'JournalController::update/$1');

    $routes->get('delete/(:num)', 'JournalController::delete/$1');
    // PDF
    $routes->get('download/pdf', 'JournalController::downloadPdf');
});

// =======================
// ADMIN
// Akun admin dibuat lewat: php spark db:seed AdminSeeder
// =======================
$routes->group('admin', ['filter' => ['auth', 'role:admin']], function ($routes) {
    $routes->get('/', 'AdminController::index');
    $routes->get('mahasiswa', 'AdminController::mahasiswa');
    $routes->get('mentor', 'AdminController::mentor');

    $routes->post('mentor/verifikasi/(:num)', 'AdminController::verifikasi/$1');
    $routes->post('mahasiswa/pembimbing/(:num)', 'AdminController::setPembimbing/$1');
    $routes->post('akun/reset-password/(:num)', 'AdminController::resetPassword/$1');
    $routes->post('akun/hapus/(:num)', 'AdminController::hapus/$1');
});

// =======================
// MENTOR
// =======================
$routes->group('mentor', ['filter' => ['auth', 'role:mentor']], function ($routes) {

    // 📋 list mahasiswa
    $routes->get('mahasiswa', 'MentorController::mahasiswa');

    // 📘 jurnal per mahasiswa
    $routes->get('mahasiswa/(:num)', 'MentorController::detailMahasiswa/$1');

    // jurnal pending & history (punyamu)
    $routes->get('journal', 'MentorController::index');
    $routes->get('history', 'MentorController::history');

    $routes->post('journal/approve/(:num)', 'MentorController::approve/$1');
    $routes->post('journal/reject/(:num)', 'MentorController::reject/$1');
    $routes->get('dashboard/mentor', 'DashboardController::mentor');
});