<?php

namespace App;

class PageFields
{
    public static function fields()
    {
        return [
            'projects' => [
                'fields' => [
                    'project_date' => 'text',
                    'apartments' => 'text',
                    'blok' => 'text',
                    'floor' => 'text',
                    'apartment_types' => 'text',
                    'apartment_square' => 'text',
                    'trade' => 'text',
                    'land_square' => 'text',
                    'address' => 'text',
                    'properties' => 'textarea',
                    'project_logo' => 'file',
                    'project_type' => 'text',
                    'logo_size' => 'text'
                ],
            ]
        ];
    }
}
