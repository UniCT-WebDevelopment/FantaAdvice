<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table-> text('google_id')->nullable();
            $table-> text('facebook_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('avatar')->default("https://i.ibb.co/vVNFX1j/user.png");
            $table->string('password');
            $table->rememberToken();
            $table->integer('credits')->default(10);
            $table->unsignedTinyInteger('is_super_admin')->default(0);
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
        Schema::dropIfExists('users');
    }
}
