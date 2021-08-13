<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    use HasFactory;

    // primary key
    public $primaryKey ='contact_id';

    // does not try to add created_at and updated_at
    public $timestamps = false;
}
