<?php

namespace App\Controllers;

use App\Models\UserModel;

/**
 * AuthController
 *
 * Mengelola autentikasi admin: login, logout.
 */
class AuthController extends BaseController
{
    protected UserModel $userModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ): void {
        parent::initController($request, $response, $logger);
        $this->userModel = new UserModel();
    }

    /**
     * Tampilkan halaman login
     */
    public function login(): string
    {
        // Jika sudah login, redirect ke dashboard
        if (session()->get('is_logged_in')) {
            return redirect()->to('/dashboard');
        }

        $data = [
            'title' => 'Login – WorldInfo',
        ];

        return view('auth/login', $data);
    }

    /**
     * Proses login
     */
    public function processLogin()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ];

        if (! $this->validate($rules)) {
            session()->setFlashdata('error', 'Format email atau password tidak valid.');
            return redirect()->to('/login')->withInput();
        }

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->verifyLogin($email, $password);

        if ($user) {
            // Set session data
            session()->set([
                'is_logged_in' => true,
                'user_id'      => $user['id'],
                'user_name'    => $user['name'],
                'user_email'   => $user['email'],
                'user_role'    => $user['role'],
            ]);

            session()->setFlashdata('success', 'Selamat datang, <strong>' . esc($user['name']) . '</strong>!');
            return redirect()->to('/dashboard');
        } else {
            session()->setFlashdata('error', 'Email atau password salah. Silakan coba lagi.');
            return redirect()->to('/login')->withInput();
        }
    }

    /**
     * Logout – hapus session dan redirect ke login
     */
    public function logout()
    {
        session()->destroy();
        session()->setFlashdata('success', 'Anda berhasil logout. Sampai jumpa!');
        return redirect()->to('/login');
    }
}
