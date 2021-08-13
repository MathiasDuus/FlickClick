<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact_site extends Model
{
    use HasFactory;

    // does not try to add created_at and updated_at
    public $timestamps = false;
}
