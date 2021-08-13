<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    // primary key
    public $primaryKey ='comment_id';

    // does not try to add created_at and updated_at
    public $timestamps = false;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
