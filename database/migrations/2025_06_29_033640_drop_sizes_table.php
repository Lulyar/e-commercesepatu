<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSizesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('sizes');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Jika Anda ingin membuat kembali tabel sizes, masukkan struktur tabel di sini.
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->string('size');
            $table->timestamps();
        });
    }
}
