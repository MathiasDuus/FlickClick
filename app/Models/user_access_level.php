<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_access_level extends Model
{
    use HasFactory;

    // primary key
    public $primaryKey ='access_id';

    // does not try to add created_at and updated_at
    public $timestamps = false;
}
