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
        Schema::create('menu_katerings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_profile_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_menu_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama');
            $table->text('deskripsi');
            $table->decimal('price', 15, 2);
            $table->string('gambar');
            $table->integer('qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_katerings');
    }
};
