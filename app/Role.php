<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    public function user()
    {
    	return $this->hasOne('App\User','roleActiveId','kode');
    }
}
