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
        Schema::create('ordered_request', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id') // inserisce la colonna della chiave esterna
                ->constrained()
                ->onDelete('cascade'); //cancellare i piatti se la tabella orders viene eliminata
            $table->foreignId('dishes_id') // inserisce la colonna della chiave esterna
                ->constrained() //crea la connessione con la tabella dishes
                ->onDelete('cascade'); //cancellare i piatti se la tabella dishes viene eliminata
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordered_request');
    }
};
