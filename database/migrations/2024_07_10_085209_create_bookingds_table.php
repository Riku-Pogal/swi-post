<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingDsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_ds', function (Blueprint $table) {
            $table->id();
            $table->integer('idh');
            $table ->string('nama_jasa', 128);
            $table ->decimal('hrg_jual', $precision = 19, $scale = 6);
            $table ->string('detail', 256);
            $table ->string('nama_terapis', 128);
            $table ->string('nama', 128);
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_ds');
    }
}
