<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('joueurs_points', function (Blueprint $table) {
            $table->id();
            $table->integer('points');
            $table->float('accuracy');
            $table->float('reaction_time');
            $table->foreignId('user_id')
                ->constrained('users', 'id')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('games_id')
                ->constrained('games', 'id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joueurs_points');
    }
};
