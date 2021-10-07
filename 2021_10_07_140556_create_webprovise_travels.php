<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebproviseTravels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webprovise_travels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('createdAt')->nullable();
            $table->string('employeeName')->nullable();
            $table->string('departure')->nullable();
            $table->string('destination')->nullable();
            $table->decimal('price',12,2)->nullable();
            $table->bigInteger('companyId')->unsigned()->nullable();

            $table->index('companyId');

            $table->foreign('companyId')->references('id')->on('webprovise_companies')->onDelete('SET NULL')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webprovise_travels');
    }
}
