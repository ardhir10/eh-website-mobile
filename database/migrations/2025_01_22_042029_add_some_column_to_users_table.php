<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            /*
            username
            role
            status
            company_id
            avatar
            */
            $table->string('username')->nullable();
            $table->string('role')->nullable();
            $table->string('status')->nullable();
            $table->integer('company_id')->nullable();
            $table->string('avatar')->nullable();
            // soft delete
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('role');
            $table->dropColumn('status');
            $table->dropColumn('company_id');
            $table->dropColumn('avatar');
            $table->dropSoftDeletes();
        });
    }
};
