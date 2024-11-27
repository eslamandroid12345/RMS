<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,


    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'teams' => 'c,r,u,d',
            'members' => 'c,r,u,d',
            'reports' => 'c,r,u,d',
            'reviews' => 'c,u,d',
            'statistics' => 'c,r,u,d',
//            'settings' => 'c,r,u,d',
//            'roles'=>'c,r,u,d',
            'projects' => 'c,r,u,d',
            'tasks' => 'c,r,u,d',
            'events' => 'c,r,u,d',
            'project_estimate' => 'c,r,u,d',
        ],
        'admin' => [
            'teams' => 'c,r,u,d',
            'members' => 'c,r,u,d',
            'reports' => 'c,r,u,d',
            'reviews' => 'c,r,u,d',
            'statistics' => 'c,r,u,d',
//            'settings' => 'c,r,u,d',
//            'roles'=>'c,r,u,d',
            'projects' => 'c,r,u,d',
            'tasks' => 'c,r,u,d',
            'events' => 'c,r,u,d',
        ],
        'user'=>[

        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
