<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoryGames extends Model
{
    protected $table = 'category_games';
    protected $primaryKey = 'id';

    use HasFactory;
}
