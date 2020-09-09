<?php
namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model{
    protected $table='comment';

    public $timestamps = false;

    public function getUser($userid){
        $usermeta = DB::table('user')->where('id','=',$userid)->first();
        return $usermeta->username;
    }

    public function getUserImg($userid){
        $usermeta = DB::table('user')->where('id','=',$userid)->first();
        return $usermeta->avater_img;
    }
}
