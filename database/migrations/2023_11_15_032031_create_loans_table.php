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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('loan_code');
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('loan_date');
            $table->date('return_date')->nullable();
            $table->string('photo_receipt')->nullable();
            $table->string('pic');
            $table->string('signature_employee');
            $table->string('signature_admin');
            $table->text('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
