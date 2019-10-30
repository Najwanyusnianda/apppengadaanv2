<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectMemberRole extends Model
{
    //
    protected $fillable=['projectId','userId','roleId'];
}
