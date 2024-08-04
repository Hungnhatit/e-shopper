<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table='comment';

    protected $primary_key= 'id';
    protected $fillable = [
        'id_comment',
        'cmt',
        'id_blog',
        'id_user',
        'avatar_user',
        'user_name',
        'level'
    ];
}
