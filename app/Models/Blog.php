<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = "blogs";

    protected $primary_key = "id";

    protected $fillable = [
        'title',
        'image',
        'description',
        'content', 
        'id_auth'
    ];
}
