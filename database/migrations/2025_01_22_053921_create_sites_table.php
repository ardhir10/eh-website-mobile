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
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            /*
            company_id
            site_name
            site_address
            site_phone
            site_email
            site_longitude
            site_latitude
            site_visibility
            site_status
            site_token
            */
            $table->foreignId('company_id')->constrained('companies');
            $table->string('site_name')->nullable();
            $table->text('site_address')->nullable();
            $table->string('site_phone')->nullable();
            $table->string('site_email')->nullable();
            $table->string('site_longitude')->nullable();
            $table->string('site_latitude')->nullable();
            $table->string('site_visibility')->default('all');
            $table->boolean('site_status')->default(true);
            $table->string('site_token')->nullable()->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
