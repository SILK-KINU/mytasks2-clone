<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $guarded = array('id');

    // 以下を追記
    public static $rules = array(
        'recipename' => 'required',
        'amount' => 'required',
        'mainmaterial' => 'required',
        'howtocook' => 'required',
    );
    
    // Newsモデルに関連付けを行う
    public function histories()
    {
      return $this->hasMany('App\History');

    }
}
