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
    Schema::create('album', function (Blueprint $table) {
      $table->id();
      $table->string('nom');
      $table->string('artiste');
      $table->string('type')->nullable();
      $table->date('date_sortie')->nullable();
      $table->string('fichier_image')->default('defaut.png');
      $table->string('duree')->default('0:00');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('album');
  }
};
