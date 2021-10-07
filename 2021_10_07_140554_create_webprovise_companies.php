<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebproviseCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webprovise_companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('createdAt')->nullable();
            $table->string('name')->nullable();
            $table->bigInteger('parentId')->unsigned()->nullable();

            $table->index('parentId');

            $table->foreign('parentId')->references('id')->on('webprovise_companies')->onDelete('SET NULL')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webprovise_companies');
    }
}
