<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticketcode')->nullable();
            $table->integer('priority_ID')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('status_id')->nullable();
            $table->integer('issue_id')->nullable();
            $table->integer('assignee_id')->nullable();
            $table->integer('user_id');
            $table->integer('department_id');
            $table->integer('requester_department_id');
            $table->string('ticket_subject');
            $table->string('ticket_description');
            $table->string('name');
            $table->string('position');
            $table->integer('assignee')->nullable();
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