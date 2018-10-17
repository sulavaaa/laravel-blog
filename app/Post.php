<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Table Name
    protected $table = 'posts';
    // Priamry Key
    public $primarykey = 'id';
    // Timestamps
    public $timestamps = true;
}
