<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AfterTableUsersAddColumnAvatar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('facebook')->after('name')->nullable();
            $table->string('img')->after('name')->nullable();
            $table->string('phone')->after('name')->nullable();
            $table->string('address')->after('name')->nullable();
            $table->string('description')->after('name')->nullable();
            $table->string('lastname')->after('name')->nullable();
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
            //
        });
    }
}
