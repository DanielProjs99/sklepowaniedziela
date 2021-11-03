<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->boolean('activated')->default(0);
            $table->boolean('deleted')->default(0);
            $table->boolean('is_admin')->default(0);
            $table->string('activation_link')->unique();
            $table->rememberToken();
            $table->timestamp('created_on')->useCurrent();
            $table->timestamp('deleted_on')->nullable();	
        });

        $admin = [
            'email' => 'admin',
            'password' => Hash::make('SilneHaslo'),
            'first_name' => 'admin',
            'last_name' => 'admin',
            'phone' => '000000000',
            'activated' => 1,
            'is_admin' => 1,
            'activation_link' => Hash::make(str_random('100')),
        ];

        DB::table('users')
            ->insert($admin);
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
}
