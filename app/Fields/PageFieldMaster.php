<?php

namespace App\Fields;

use App\PageFields;

/**
 * Class PageFieldMaster
 * @package App\Fields
 */
class PageFieldMaster
{
    /**
     * @var array
     */
    public $defaultFields;

    /**
     * PageFieldMaster constructor.
     */
    public function __construct()
    {
        $this->defaultFields = [
            Input::make('Başlık', 'title'),
        ];
    }

    /**
     * @param null $pageType
     * @return array
     */
    public function get($pageType = null): array
    {
        if ($pageType == null) {
            $pageType = request()->type ?? abort(404);
        }

        method_exists(PageFields::class, $pageType)
            ? $method = $this->$pageType()
            : abort(404);

        return array_merge(
            ['fields' => array_merge($this->defaultFields, $method['fields'])],
            ['page_details' => [
                'page_name' => $method['page_name'],
                'method_name' => $pageType,
                'icon' => $method['icon'],
                // For other settings or details (v-Alpha)
            ]]
        );
    }
}
