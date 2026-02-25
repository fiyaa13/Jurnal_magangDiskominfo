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
});