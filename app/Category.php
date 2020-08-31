<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{
    protected $table = 'category';

    public $timestamps = false;

    public function fromDateTime($value)
    {
        return empty($value) ? $value : $this->getDateFormat();
    }

}
