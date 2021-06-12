<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->default(null);
            $table->string('logo')->nullable()->default(null);
            $table->string('favicon')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->string('address')->nullable()->default(null);
            $table->text('introduction')->nullable()->default(null);
            $table->text('map')->nullable()->default(null);
            $table->string('facebook')->nullable()->default(null);
            $table->string('twitter')->nullable()->default(null);
            $table->string('google')->nullable()->default(null);
            $table->string('youtube')->nullable()->default(null);
            $table->text('working_hours')->nullable()->default(null);
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
        Schema::dropIfExists('sites');
    }
}
