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
            $table->dropColumn(['name', 'password', 'email', 'email_verified_at']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->after('id')->unique();
            $table->string('firstname')->nullable()->after('name');
            $table->string('lastname')->nullable()->after('firstname');
            $table->string('address')->nullable()->after('lastname');
            $table->string('zipcode')->nullable()->after('address');
            $table->integer('country_id')->nullable()->after('zipcode');
            $table->string('password')->nullable()->after('country_id');
            $table->integer('status')->default(0)->after('password');
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
            $table->dropColumn('firstname');
            $table->dropColumn('lastname');
            $table->dropColumn('address');
            $table->dropColumn('zipcode');
            $table->dropColumn('country_id');
        });


    }
}
