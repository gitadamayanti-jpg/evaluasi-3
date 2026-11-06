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
        Schema::table('digicams', function (Blueprint $table) {
            $table->string('nama')->after('id');
            $table->string('merek')->after('nama');
            $table->decimal('harga', 12, 2)->after('merek');
            $table->integer('stok')->after('harga');
            $table->text('deskripsi')->nullable()->after('stok');
            $table->string('foto', 100)->nullable()->after('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('digicams', function (Blueprint $table) {
            //
        });
    }
};
