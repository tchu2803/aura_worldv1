<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('variant_attributes', function (Blueprint $table) {
            $table->id('variant_attributes_id');
            $table->foreignId('variant_id')->constrained('variants')->onDelete('cascade');
            $table->foreignId('attribute_value_id')->constrained('attributes_values')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('variant_attributes');
    }
};