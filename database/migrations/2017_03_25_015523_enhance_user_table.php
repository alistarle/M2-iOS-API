<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EnhanceUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string("avatarUrl");
            $table->string("phone")->nullable();
            $table->text("address");
            $table->integer("cp");
            $table->string("city");
            $table->integer("range_km");
            $table->integer("price");

            $table->integer('role_id')->unsigned()->index();
            $table->string('role_type');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("avatarUrl");
            $table->dropColumn("phone");
            $table->dropColumn("address");
            $table->dropColumn("cp");
            $table->dropColumn("city");
            $table->dropColumn("range_km");
            $table->dropColumn("price");
            $table->dropColumn('role_id');
            $table->dropColumn('role_type');
        });

    }
}
