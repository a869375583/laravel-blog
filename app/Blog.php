<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model{
    protected $table = 'post';

    protected $fillable = ['post_name','content','cate_id'];

    public $timestamps = false;

    public function fromDateTime($value)
    {
        return empty($value) ? $value : $this->getDateFormat();
    }


    public function tranTime($time)
    {
        $time = strtotime($time);
        $rtime = date("m-d H:i",intval($time));
        $time = time() - intval($time);
        if ($time < 60)
        {
            $str = '刚刚';
        }
        elseif ($time < 60 * 60)
        {
            $min = floor($time/60);
            $str = $min.'分钟前';
        }
        elseif ($time < 60 * 60 * 24)
        {
            $h = floor($time/(60*60));
            $str = $h.'小时前 ';
        }
        elseif ($time < 60 * 60 * 24 * 30 * 12)
        {
            $h = floor($time/(60*60*24));
            if ($h<=30){
                $str = $h.'天前 ';
            }else{
                $ch = round ($h/30);
                $str = $ch.'月前 ';
            }

        }
        else
        {
            $str = $rtime;
        }
        return $str;
    }
}


