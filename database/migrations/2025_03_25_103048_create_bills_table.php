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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hostel_id')->constrained('hostels');
            $table->foreignId('bill_status_id')->constrained('bill_statuses');
            $table->enum('type',['all','user'])->default('all');
            $table->text('note')->nullable();
            $table->decimal('amount');
            $table->date('bill_month');
            $table->unsignedBigInteger('border_id')->nullable()->comment('if spacific border bill amount add.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }

};
