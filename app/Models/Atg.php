<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atg extends Model
{
    protected $table = 'persons';
    protected $guarded = ['id','created_at','updated_at'];
    
}
