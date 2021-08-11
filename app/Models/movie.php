<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movie extends Model
{
    use HasFactory;

    // primary key
    public $primaryKey ='movie_id';


    /*protected $genre = '';

    public function getGnere()
    {
        return $this->genre;
    }

    public function setGenre($value)
    {
        $this->genre = $value;
    }

    protected $comment_count = 0;

    public function getCommentCount(){
        return $this->comment_count;
    }

    public function setCommentCount($value){
        $this->comment_count = $value;
    }*/
}
