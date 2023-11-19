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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('name');
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('job_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('gender');
            $table->string('email');
            $table->text('address');
            $table->string('phone_number', 15);
            $table->string('photo')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
