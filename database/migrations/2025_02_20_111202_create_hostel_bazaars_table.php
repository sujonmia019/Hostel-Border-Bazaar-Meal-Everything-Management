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
        Schema::create('hostel_bazaars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('hostel_id')->constrained('hostels');
            $table->foreignId('user_id')->constrained('users');
            $table->text('name');
            $table->decimal('amount',8,2);
            $table->date('date');
            $table->enum('status',[1,2])->default(1)->comment('1 = Approved, 2 = Pending');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hostel_bazaars');
    }
};
