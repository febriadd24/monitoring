<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class manifest extends Model
{
    protected $table = 'manifest';
    protected $fillable = [
        'id','UID', 'PCID', 'CONFIG',
     ];
}
