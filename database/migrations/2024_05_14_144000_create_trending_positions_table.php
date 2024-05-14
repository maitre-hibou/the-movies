<?php

use App\Models\Movie;
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
        Schema::create('trending_positions', function (Blueprint $table) {
            $table->id();
            $table->string('period_type');
            $table->string('period');
            $table->integer('position');

            $table->foreignUuid('movie_id')->constrained('movies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trending_positions');
    }
};
