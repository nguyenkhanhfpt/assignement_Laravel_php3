<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name_member');
            $table->string('email')->unique();
            $table->string('phone_number', 11)->nullable();
            $table->string('address')->nullable();
            $table->text('password');
            $table->string('gender', 10)->nullable();
            $table->string('img_member');
            $table->tinyInteger('role');
            $table->tinyInteger('status_member');
            $table->string('provider_name', 200)->nullable();
            $table->string('provider_id', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
