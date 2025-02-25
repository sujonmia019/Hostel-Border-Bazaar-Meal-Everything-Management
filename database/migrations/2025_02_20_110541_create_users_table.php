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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hostel_id')->constrained('hostels');
            $table->enum('role',[1,2,3])->default(3)->comment('1 = super-admin, 2 = hostel-admin, 3 = border');
            $table->string('name');
            $table->string('username', 20);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('gender',[1,2])->nullable()->comment('1 = Male, 2 = Female');
            $table->string('image')->nullable();
            $table->text('bio')->nullable();
            $table->enum('status',[1,2])->default(1)->comment('1 = Active, 2 = Inactive');
            $table->rememberToken();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
