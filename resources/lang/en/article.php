<?php

// return [

    
//     |--------------------------------------------------------------------------
//     | Pagination Language Lines
//     |--------------------------------------------------------------------------
//     |
//     | The following language lines are used by the paginator library to build
//     | the simple pagination links. You are free to change them to anything
//     | you want to customize your views to better match your application.
//     |
    

//     '' => '',
//     '' => '',

// ];

return [

    'unavailable_audits' => 'No Article Audits available',

    'updated'            => [
        'metadata' => 'On :audit_created_at, :user_name [:audit_ip_address] updated this record via :audit_url',
        'modified' => [
            'title'   => 'The Title has been modified from <strong>:old</strong> to <strong>:new</strong>',
            'content' => 'The Content has been modified from <strong>:old</strong> to <strong>:new</strong>',
        ],
    ],

    'attribute'  => 'Attribute',
    'event'      => 'Event',
    'id'         => 'ID',
    'ip_address' => 'IP Address',
    'user_agent' => 'User Agent',
    'new'        => 'New',
    'old'        => 'Old',
    'url'        => 'URL',
    'user'       => 'User',
    'tags'       => 'Tags',
];