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
            $table->text('token')->nullable();
            $table->text('refresh_token')->nullable();
            $table->timestamp('token_expired_at')->nullable();
            $table->timestamp('refresh_token_expired_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('token');
            $table->dropColumn('refresh_token');
            $table->dropColumn('token_expired_at');
            $table->dropColumn('refresh_token_expired_at');
        });
    }
};
