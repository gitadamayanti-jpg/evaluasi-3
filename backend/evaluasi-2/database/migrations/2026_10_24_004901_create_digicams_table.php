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
    Schema::create('digicams', function (Blueprint $table) {
        $table->id('id_digicam');
        $table->string('nama');
        $table->string('merek');
        $table->decimal('harga', 12, 2);
        $table->integer('stok');
        $table->text('deskripsi')->nullable();
        $table->string('foto', 100)->nullable();
        $table->unsignedBigInteger('id_kategori')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('digicams');
    }
};
