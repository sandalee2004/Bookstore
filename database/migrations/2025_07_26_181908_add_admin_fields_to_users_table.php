<?php
// database/migrations/xxxx_xx_xx_add_admin_fields_to_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->text('address')->nullable()->after('phone');
            $table->string('city')->nullable()->after('address');
            $table->string('state')->nullable()->after('city');
            $table->string('zip_code')->nullable()->after('state');
            $table->string('country')->nullable()->after('zip_code');
            $table->boolean('is_admin')->default(false)->after('country');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'address', 'city', 'state', 'zip_code', 'country', 'is_admin'
            ]);
        });
    }
};