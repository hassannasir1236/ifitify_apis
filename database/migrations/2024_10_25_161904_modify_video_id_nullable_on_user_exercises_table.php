<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyVideoIdNullableOnUserExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_exercises', function (Blueprint $table) {
            $table->unsignedBigInteger('video_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_exercises', function (Blueprint $table) {
            $table->unsignedBigInteger('video_id')->nullable(false)->change();
        });
    }
}
