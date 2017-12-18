<?php

return [
    'pagetitles' => [
        'projects.index' => 'All projects',
        'projects.create' => 'New project',
        'projects.edit' => 'Edit project',
        'projects.show' => 'Project details',

        'projects.tasks.index' => 'Project tasks',
        'projects.tasks.create' => 'New task',
        'projects.tasks.edit' => 'Edit task',
        'projects.tasks.show' => 'Task details',

        'projects.credentials.index' => 'Project credentials',
        'projects.credentials.create' => 'New credential',
        'projects.credentials.edit' => 'Edit credential',
        'projects.credentials.show' => 'Credential details',

        'statuses.index' => 'All statuses',
        'statuses.create' => 'New status',
        'statuses.edit' => 'Edit status',

        'tasks.comments.index' => 'Task comments',
        'tasks.comments.create' => 'New comment',
        'tasks.comments.edit' => 'Edit comment',

        'users.index' => 'All clients',
        'users.create' => 'New client',
        'users.edit' => 'Edit client',

        'dashboard' => 'Dashboard',
    ],
    'default' => [
        'statuses' => ['Draft','Open','On Going','Close','Cancel'],
        'role' => 'client',
        'permissions' => [
            'create_projects',
            'edit_projects',
            'edit_projects_status',
            'view_projects',
            'delete_projects',
            'create_tasks',
            'edit_tasks',
            'edit_tasks_status',
            'view_tasks',
            'delete_tasks',
            'create_comments',
            'edit_comments',
            'view_comments',
            'delete_comments',
            'create_credentials',
            'edit_credentials',
            'view_credentials',
            'delete_credentials',
            'create_statuses',
            'edit_statuses',
            'view_statuses',
            'delete_statuses',
            'create_users',
            'edit_users',
            'view_users',
            'delete_users'
        ],
        'rolepermissions' => [
            'client' => [
                'create_projects',
                'edit_projects',
                'view_projects',
                'create_tasks',
                'edit_tasks',
                'edit_tasks_status',
                'view_tasks',
                'create_comments',
                'edit_comments',
                'view_comments',
                'create_credentials',
                'edit_credentials',
                'view_credentials',
            ]
        ]
    ]
];
