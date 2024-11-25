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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->text('image')->nullable();
            $table->boolean('visibility')->nullable();
            $table->foreignId('restaurant_id')
                ->constrained('restaurants')
                ->onDelete('cascade')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Verifica se la tabella 'ordered_request' esiste
        if (Schema::hasTable('ordered_request')) {
            Schema::table('ordered_request', function (Blueprint $table) {
                if (Schema::hasColumn('ordered_request', 'dish_id')) {
                    $table->dropForeign(['dish_id']); // Rimuove il vincolo
                }
            });
        }

        // Elimina la tabella 'dishes'
        Schema::dropIfExists('dishes');
    }
};

