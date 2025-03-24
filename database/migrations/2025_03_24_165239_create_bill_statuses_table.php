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
        Schema::create('bill_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hostel_id')->constrained('hostels');
            $table->string('name');
            $table->enum('status',[1,2])->default(1)->comment('1 = Active, 2 = Inactive');
            $table->datetime('created_at');
            $table->datetime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_statuses');
    }
};
