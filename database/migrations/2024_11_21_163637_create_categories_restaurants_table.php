<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories_restaurants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categories_id') // inserisce la colonna della chiave esterna
                ->constrained('categories') //crea la connessione con la tabella categories
                ->onDelete('cascade'); //cancellare i piatti se la tabella categories viene eliminata
            $table->foreignId('restaurant_id') // inserisce la colonna della chiave esterna
                ->constrained('restaurants') //crea la connessione con la tabella restaurants
                ->onDelete('cascade'); //cancellare i piatti se la tabella restaurants viene eliminata
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories_restaurants');
    }
};
