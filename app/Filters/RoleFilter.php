<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $role = session()->get('role');

        // kalau belum login
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // cek role
        if ($arguments && ! in_array($role, $arguments)) {
            return redirect()->to('/dashboard')
                ->with('error', 'Akses tidak diizinkan');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // kosong
    }
}