<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 12, 2);
            $table->decimal('rating', 2, 1)->default(0);
            $table->string('gambar')->nullable();
            $table->foreignId('kategori_id')
                ->nullable()
                ->constrained('kategoris')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
      public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn([
                'nama',
                'deskripsi',
                'harga',
                'rating',
                'gambar',
                'kategori_id'
            ]);
        });
    }
};