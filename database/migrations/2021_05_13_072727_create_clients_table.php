<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('clients')) {
            Schema::create('clients', function (Blueprint $table) {
                $table->id();
                $table->string('client_name', 100);
                $table->text('address1');
                $table->text('address2');
                $table->string('city', 100);
                $table->string('state', 100);
                $table->string('country', 100);
                $table->double('latitude');
                $table->double('longitude');
                $table->string('phone_no1', 20);
                $table->string('phone_no2', 20)->nullable();
                $table->string('zip', 20);
                $table->date('start_validity')->default(date("Y-m-d H:i:s"));
                $table->date('end_validity')->default(date('Y-m-d H:i:s',strtotime('+15 days')));
                $table->enum('status', ['Active', 'Inactive']);
                $table->timestamps();
                $table->softDeletes();
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
        Schema::dropIfExists('clients');
    }
}
