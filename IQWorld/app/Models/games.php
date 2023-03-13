<?php

namespace App\Models;

use App\Models\categoryGames;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class games extends Model
{
    use HasFactory;

    // Méthode permettant la liaison entre games et CategoryGames
    public function categoryGames()
    {
        return $this->belongsTo(categoryGames::class, 'category_id');
    }
}
