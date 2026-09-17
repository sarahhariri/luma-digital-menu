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
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->id();
           
        $table->foreignId('product_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->string('name');
        $table->decimal('price', 8, 2);
        $table->boolean('is_default')->default(false);
        $table->unsignedInteger('order')->default(0);
        $table->boolean('is_active')->default(true);

        $table->timestamps();

        $table->unique(['product_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sizes');
    }
};
