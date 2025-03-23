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
        Schema::create('meals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('hostel_id')->constrained('hostels');
            $table->foreignId('user_id')->constrained('users');
            $table->integer('total_meal');
            $table->enum('meal_type',[1,2,3,4])->comment('1 = breakfast, 2 = lunch, 3 = dinner, 4 = others');
            $table->text('comment')->nullable();
            $table->date('meal_date');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meals');
    }
};
