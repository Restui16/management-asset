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
        Schema::create('asset_returns', function (Blueprint $table) {
            $table->id();
            $table->string('return_code');
            $table->foreignId('loan_id')->constrained('loans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('return_date');
            $table->string('condition');
            $table->text('notes')->nullable();
            $table->string('photo_receipt')->nullable();
            $table->string('signature_admin');
            $table->string('signature_employee');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_returns');
    }
};
