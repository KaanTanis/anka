<?php

namespace App\Fields;

use App\PageFields;

/**
 * Class Fields
 * @package App\Fields
 */
class Fields
{
    /**
     * @param null $label
     * @param null $name
     * @param bool $fieldsTable
     * @return Fields
     */
    public static function make($label = null, $name = null, bool $fieldsTable = true, $col = 12): Fields
    {
        return (new static)
            ->label($label)
            ->name($name)
            ->fieldsTable($fieldsTable)
            ->col($col);
    }

    /**
     * @var
     */
    public $name;
    /**
     * @var
     */
    public $placeholder;
    /**
     * @var
     */
    public $label;
    /**
     * @var
     */
    public $required;
    /**
     * @var
     */
    public $value;
    /**
     * @var
     */
    public $type;
    /**
     * @var
     */
    public $multiple;
    /**
     * @var
     */
    public $fieldsTable;
    /**
     * @var
     */
    public $col;
    /**
     * @var
     */
    public $tinymce;

    /**
     * @param $label
     * @return $this
     */
    public function label($label): Fields
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @param $name
     * @return $this
     */
    public function name($name): Fields
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param $placeholder
     * @return $this
     */
    public function placeholder($placeholder): Fields
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function value($value): Fields
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param $type
     * @return $this
     */
    public function type($type): Fields
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return $this
     */
    public function required(): Fields
    {
        $this->required = true;
        return $this;
    }

    /**
     * @return $this
     */
    public function multiple(): Fields
    {
        $this->multiple = 'multiple';
        return $this;
    }

    /**
     * @return $this
     */
    public function fieldsTable($status): Fields
    {
        $this->fieldsTable = $status;
        return $this;
    }

    /**
     * @return $this
     */
    public function col($col): Fields
    {
        $this->col = $col;
        return $this;
    }

    /**
     * @return $this
     */
    public function tinymce(): Fields
    {
        $this->tinymce = true;
        return $this;
    }
}
