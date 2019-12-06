<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['email', 'email_verified_at']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('lastname')->after('name');
            $table->string('address')->after('lastname');
            $table->string('zipcode')->after('address');
            $table->string('country_id')->after('zipcode');

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
            $table->dropColumn('lastname');
            $table->dropColumn('address');
            $table->dropColumn('zipcode');
            $table->dropColumn('country_id');
        });


    }
}
