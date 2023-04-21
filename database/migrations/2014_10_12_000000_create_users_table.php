<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->tinyInteger('status')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('device')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
           // Create admin account
           DB::table('users')->insert([
            'name' => 'Admin',
            'image' => null,
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'status' => 1,
            'email_verified_at' => now(),
            'is_email_verified' => 1,
            'password' => Hash::make('password'),
            'device' => null,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
