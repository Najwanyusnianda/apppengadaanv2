<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisposisiPermintaan extends Model
{
    //
    protected $fillable=["permintaan_id","from_id","to_id","konten","disposisi_level"];
}
