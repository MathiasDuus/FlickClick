<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class job extends Model
{
    use HasFactory;

    // primary key
    public $primaryKey ='job_id';

    // does not try to add created_at and updated_at
    public $timestamps = false;
}
