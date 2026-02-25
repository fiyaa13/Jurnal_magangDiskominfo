<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function process()
    {
        $userModel = new UserModel();

        $user = $userModel
            ->where('email', $this->request->getPost('email'))
            ->first();

        if (! $user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan');
        }

        if (! password_verify(
            $this->request->getPost('password'),
            $user['password']
        )) {
            return redirect()->back()->with('error', 'Password salah');
        }

        session()->set([
            'logged_in' => true,
            'id'        => $user['id'],   // 🔥 SATU ID SAJA
            'name'      => $user['name'],
            'role'      => $user['role']
        ]);

        return redirect()->to('/dashboard');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function saveRegister()
    {
        $userModel = new UserModel();

        $userModel->insert([
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'role'     => $this->request->getPost('role')
        ]);

        return redirect()->to('/login')
            ->with('success', 'Registrasi berhasil, silakan login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}