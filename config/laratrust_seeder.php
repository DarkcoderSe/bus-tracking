<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'admin' => [
            'users' => 'c,r,u,d',
            'payments' => 'c,r,u,d',
            'profile' => 'r,u',
            'vehicle' => 'c,r,u,d',
        ],
        'driver' => [
            'profile' => 'r,u',
            'vehicle' => 'r'
        ],
        'teacher' => [
            'profile' => 'r,u',
            'vehicle' => 'r'
        ],
        'student' => [
            'profile' => 'r,u',
            'vehicle' => 'r'
        ],
        'role_name' => [
            'module_1_name' => 'c,r,u,d',
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
