<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('shoes', function (Blueprint $table) {
        $table->decimal('rating', 3, 2)->default(0); // Menambahkan kolom rating
    });
}

public function down()
{
    Schema::table('shoes', function (Blueprint $table) {
        $table->dropColumn('rating'); // Menghapus kolom rating jika rollback
    });
}

};
