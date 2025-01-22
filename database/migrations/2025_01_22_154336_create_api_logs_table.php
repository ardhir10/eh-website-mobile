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
        Schema::create('api_logs', function (Blueprint $table) {
            $table->id();
            // data: {
            //     pH: '7.6661',
            //     tss: '135.0268',
            //     nh3n: '2.0832',
            //     cod: '206.1440',
            //     debit: '4084.1957',
            //     totalizer: '1526124',
            //     datetime: 1737560631,
            //     token: 'wOoFD2OeWwgXAeLgoKalw24rcnpg4u6Y'
            //     status_send: 'success'
            //   }
            $table->float('ph')->nullable();
            $table->float('tss')->nullable();
            $table->float('nh3n')->nullable();
            $table->float('cod')->nullable();
            $table->float('debit')->nullable();
            $table->float('totalizer')->nullable();
            $table->string('token')->nullable();
            $table->string('datetime')->nullable();
            $table->string('datetime_client_formated')->nullable();
            $table->string('status_send')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_logs');
    }
};
