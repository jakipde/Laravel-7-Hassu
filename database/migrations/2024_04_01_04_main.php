<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Main extends Migration
{
    public function up()
    {
        Schema::create('mains', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('part_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('rak_id');
            $table->string('shift');
            $table->unsignedBigInteger('in');
            $table->unsignedBigInteger('out');
            $table->unsignedBigInteger('sisa');
            $table->string('pic');
            $table->string('pic_name');
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('part_id')->references('id')->on('parts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('rak_id')->references('id')->on('raks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('mains');
    }
}
