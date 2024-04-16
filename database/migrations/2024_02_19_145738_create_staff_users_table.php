<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_users', function (Blueprint $table) {
            $table->id();
            $table->text('image')->nullable();
            $table->string('name', 255);
            $table->string('slug')->nullable();
            $table->boolean('is_active')->default(true)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->nullable();
            
            $table->unsignedBigInteger('employees_id');
            $table->foreign('employees_id')->references('id')->on('_employees')->nullable();
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
        Schema::dropIfExists('staff_users');
    }
}
