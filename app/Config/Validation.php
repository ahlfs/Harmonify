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
            'rules' => 'alpha_numeric|is_unique[user.Username]',  
            'errors' => [
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
            'errors'=> [
                'matches' => 'Konfirmasi password tidak cocok'
            ]
        ],
    ];
}
