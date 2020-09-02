<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Postmeta extends Model{
    protected $table = 'postmeta';

    public $timestamps = false;

    public function fromDateTime($value)
    {
        return empty($value) ? $value : $this->getDateFormat();
    }
}
