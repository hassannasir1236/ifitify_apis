<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExerciseIdToUserExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_exercises', function (Blueprint $table) {
            $table->unsignedBigInteger('exercise_id')->nullable()->after('id');
            
            // Optional: add foreign key constraint
            $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('set null');
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
            $table->dropForeign(['exercise_id']);
            $table->dropColumn('exercise_id');
        });
    }
}
