<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemohonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemohons', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string("phone")->unique();
            $table->string("nik")->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum("jk", ["L", "K"]);
            $table->date('tgl_lahir');
            $table->unsignedInteger('kelurahan_id');
            $table->text("address");
            $table->string("avatar");
            $table->enum("status", ["ACTIVE", "INACTIVE"]);
            $table->string('password');
            $table->rememberToken();
            $table->integer("created_by");
            $table->integer("updated_by")->nullable();
            $table->integer("deleted_by")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemohons');
    }
}
