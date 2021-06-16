<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger("izin_id");
            $table->foreignUuid('pemohon_id');
            $table->boolean('verified_kasi')->nullable();
            $table->boolean('verified_kadis')->nullable();
            $table->boolean('survey')->nullable();
            $table->string('status')->nullable();
            $table->integer("syarat_count");
            $table->foreign("izin_id")->references("id")->on('izins');
            $table->foreign("pemohon_id")->references("id")->on('pemohons');
            $table->integer("created_by");
            $table->integer("updated_by")->nullable();
            $table->integer("deleted_by")->nullable();
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
        Schema::dropIfExists('pengajuans');
    }
}
