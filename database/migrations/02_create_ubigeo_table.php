<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubigeo', function (Blueprint $table) {
            $table->increments('ubigeo_id');
            // $table->string('ubigeo_code', 6);
            $table->string('ubigeo_country', 50);
            $table->string('ubigeo_department', 50);
            $table->string('ubigeo_municipality', 50);
            $table->unsignedInteger('record_state')->default('1');
            $table->timestamp('ubigeo_created_at')->useCurrent();
            $table->timestamp('ubigeo_updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ubigeo');
    }
};
