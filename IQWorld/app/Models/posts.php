<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class posts extends Model
{
    use HasFactory;

    // Méthode permettant la liaison entre games et CategoryGames
    public function users()
    {
        return $this->belongsTo(User::class, 'id_author');
    }
}
