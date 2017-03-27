<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->double("distance")->nullable();
            $table->date("sessionDate");
            $table->time("begin");
            $table->time("end");
            $table->integer("rate")->nullable();
            $table->text("description")->nullable();
            $table->integer("status")->default(0);

            $table->integer('monitor_id')->unsigned()->nullable()->index();
            $table->foreign('monitor_id')->references('id')->on('monitors')->onDelete('cascade');

            $table->integer('student_id')->unsigned()->nullable()->index();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->integer('creator_id')->unsigned()->index();
            $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
        DB::statement('ALTER TABLE sessions ADD departure POINT' );
        DB::statement('ALTER TABLE sessions ADD arrival POINT' );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
