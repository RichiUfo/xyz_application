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
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('client_id')->unsigned();
                $table->string('first_name', 50);
                $table->string('last_name', 50);
                $table->string('email', 150)->unique();
                $table->string('password', 256);
                $table->string('phone', 20);
                $table->string('profile_uri', 255);
                $table->timestamp('last_password_reset')->useCurrent();
                $table->enum('status', ['Active', 'Inactive']);
                $table->timestamps();
                $table->softDeletes();
            });
            Schema::table('users', function($table) {
                $table->foreign('client_id')->references('id')->on('clients');
            });
        }
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
