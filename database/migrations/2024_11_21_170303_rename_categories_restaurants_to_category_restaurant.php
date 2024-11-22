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
        Schema::rename('categories_restaurants', 'category_restaurant');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('category_restaurant', 'categories_restaurants');
    }
};
