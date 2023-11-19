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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('vendors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('category_asset_id')->constrained('category_assets')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('location_id')->constrained('locations')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->string('serial_number')->nullable();
            $table->integer('price');
            $table->date('purchase_date');
            $table->text('description');
            $table->enum('condition', ['good', 'not bad', 'bad']);
            $table->enum('status', ['available', 'loaned']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
