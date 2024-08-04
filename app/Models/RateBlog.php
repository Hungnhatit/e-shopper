<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateBlog extends Model
{
    use HasFactory;
    protected $table='rate';
    protected $fillable = [
        'id_blog',
        'id_user',
        'rate'
    ];
}
