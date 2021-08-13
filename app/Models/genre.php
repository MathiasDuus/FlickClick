<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class genre extends Model
{
    use HasFactory;

    // primary key
    public $primaryKey ='genre_id';

    // does not try to add created_at and updated_at
    public $timestamps = false;

    protected $fillable = [
        'genre_name',
    ];
}
