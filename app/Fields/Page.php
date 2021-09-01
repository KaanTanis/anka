<?php

namespace App\Fields;

/**
 * Class Page
 * @package App\Fields
 */
class Page
{
    /**
     * @param $pageName
     * @param $fields
     * @param string $icon
     * @return array
     */
    public static function make($pageName, $fields, $limit = null, $icon = 'fa fa-dot-circle-o'): array
    {
        return [
            'page_name' => $pageName,
            'fields' => $fields,
            'limit' => $limit,
            'icon' => $icon
        ];
    }
}
