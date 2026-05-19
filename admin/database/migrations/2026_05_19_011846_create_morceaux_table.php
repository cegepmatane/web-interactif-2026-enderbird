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
        Schema::create('morceaux', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('id_album')
                ->constrained('albums')
                ->onDelete('cascade');
        
            $table->integer('ordre')->nullable();
        
            $table->string('titre');
        
            $table->string('artiste')->nullable();
        
            $table->string('duree')->default('0:00');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('morceaux');
    }
};
