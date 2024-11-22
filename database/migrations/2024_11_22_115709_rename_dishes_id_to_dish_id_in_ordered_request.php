<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('ordered_request', function (Blueprint $table) {
            $table->dropForeign(['dishes_id']);
            $table->dropColumn('dishes_id');
            $table->foreignId('dish_id')
                ->constrained('dishes')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('ordered_request', function (Blueprint $table) {
            $table->dropForeign(['dish_id']);
            $table->dropColumn('dish_id');
            $table->foreignId('dishes_id')
                ->constrained('dishes')
                ->onDelete('cascade');
        });
    }


};
