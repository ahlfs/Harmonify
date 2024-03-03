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
        'usernameRegister' => [
            'rules' => 'required|min_length[5]|alpha_numeric|is_unique[user.Username]|max_length[15]',
            'errors' => [
                'required' => 'Username need to be filled',
                'min_length' => 'Username must be at least 5 characters',
                'alpha_numeric' => 'Username can only contain letters and numbers',
                'is_unique' => 'Username has been taken',
                'is_lowercase' => 'Username must be lowercase',
                'max_length' => 'Username maximum 15 characters'
            ]
        ],
        'passwordRegister' => [
            'rules' => 'required|min_length[8]|alpha_numeric_punct',
            'errors' => [
                'min_length' => 'Password must be at least 8 characters',
                'alpha_numeric_punct' => 'Password can only contain letters, numbers, and punctuation'
            ]
        ],
        'confirmRegister' => [
            'rules' => 'required|matches[passwordRegister]',
            'errors' => [
                'required' => 'Confirm password need to be filled',
                'matches' => 'Confirm password does not match with password'
            ]
        ],
        'emailRegister' => [
            'rules' => 'required|valid_email|is_unique[user.Email]',
            'errors' => [
                'required' => 'Email need to be filled',
                'valid_email' => 'Email is not valid',
                'is_unique' => 'Email already registered'
            ]
        ],
    ];

    public $updateprofile = [
        'username' => [
            'rules' => 'required|min_length[5]|alpha_numeric|max_length[15]',
            'errors' => [
                'required' => 'Username need to be filled',
                'min_length' => 'Username must be at least 5 characters',
                'alpha_numeric' => 'Username can only contain letters and numbers',
                'max_length' => 'Username maximum 15 characters'
            ]
        ],
        'photoprofile' => [
            'rules' => 'permit_empty|max_size[foto,10240]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png,image/webp,image/svg]',
            'errors' => [
                'max_size' => 'File size is too large (max 10MB)',
                'is_image' => 'File that you choose is not an image',
                'mime_in' => 'File that you choose is not an image',
            ]
        ],
    ];

    public $postphoto = [
        'foto' => [
            'rules' => 'max_size[foto,10240]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png,image/webp,image/svg]',
            'errors' => [
                'max_size' => 'File size is too large (max 10MB)',
                'is_image' => 'File that you choose is not an image',
                'mime_in' => 'File that you choose is not an image',
            ]
        ],
    ];

    public $resetpassword = [
        'password' => [
            'rules' => 'required|min_length[8]',
            'errors' => [
                'required' => 'Password need to be filled',
                'min_length' => 'Password must be at least 8 characters',
            ]
        ],
    ];

    public $changepassword = [
        'newpassword' => [
            'rules' => 'required|min_length[8]',
            'errors' => [
                'required' => 'Password need to be filled',
                'min_length' => 'Password must be at least 8 characters',
            ]
        ],
        'confirm' => [
            'rules' => 'required|matches[newpassword]',
            'errors' => [
                'required' => 'Confirm Password need to be filled',
                'matches' => 'Confirm Password does not match with New Password',
            ]
        ],
    ];
}
