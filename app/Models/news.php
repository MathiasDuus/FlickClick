<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    use HasFactory;

    // primary key
    public $primaryKey ='news_id';

    protected $fillable = [
        'title',
        'news_body',
        'deck',
    ];
}
