<?php

namespace App\Controllers;

class AboutController extends BaseController
{
    public function index(): string
    {
        $data = [
            'title'       => 'Tentang WorldInfo',
            'active_menu' => 'about',
        ];

        return view('layouts/public_layout', [
            'content'     => view('about/index', $data),
            'title'       => 'Tentang - WorldInfo',
        ]);
    }
}
