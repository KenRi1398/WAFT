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
        Schema::create('userLogs', function (Blueprint $table) {
            $table->id();
            $table->string('userlog_token');
            $table->integer('user_id');
            $table->integer('ticket_id');
            $table->string('state');
            $table->datetime('dateRecord');
            $table->string('Remarks');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
