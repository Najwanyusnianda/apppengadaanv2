<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SubjectMatter extends Authenticatable
{
    //
    use Notifiable;

    protected $fillable = ['username','email',  'password'];
    protected $hidden = ['password', 'remember_token'];
}
