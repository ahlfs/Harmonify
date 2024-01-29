<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public $register = [
        'username' => [
            'rules' => 'required|min_length[5]|alpha_numeric|is_unique[user.Username]',
            'errors' => [
                'required' => 'Username harus diisi',
                'min_length' => 'Username harus terdiri dari 5 huruf',
                'alpha_numeric' => 'Username hanya boleh mengandung huruf dan angka',
                'is_unique' => 'Username sudah dipakai'
            ]
        ],
        'password' => [
            'rules' => 'min_length[8]|alpha_numeric_punct',
            'errors' => [
                'min_length' => 'Password harus terdiri dari 8 kata',
                'alpha_numeric_punct' => 'Password hanya boleh mengandung angka, huruf, dan karakter yang valid'
            ]
        ],
        'confirm' => [
            'rules' => 'matches[password]',
            'errors' => [
                'matches' => 'Konfirmasi password tidak cocok'
            ]
        ],
    ];

    public $updateprofile = [
        'username' => [
            'rules' => 'required|min_length[5]|alpha_numeric',
            'errors' => [
                'required' => 'Username harus diisi',
                'min_length' => 'Username harus terdiri dari 5 huruf',
                'alpha_numeric' => 'Username hanya boleh mengandung huruf dan angka',
            ]
        ],
        'email' => [
            'rules' => 'permit_empty|valid_email|is_unique[user.Email]',
            'errors' => [
                'valid_email' => 'Penulisan email tidak valid',
                'is_unique' => 'Email sudah terdaftar'
            ]
        ],
        'fotoprofile' => [
            'rules' => 'permit_empty|max_size[foto,10240]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png,image/webp,image/svg]',
            'errors' => [
                'max_size' => 'Ukuran gambar terlalu besar (max 10MB)',
                'is_image' => 'File yang anda pilih bukan gambar',
                'mime_in' => 'File yang anda pilih bukan gambar',
            ]
        ],
    ];
}
