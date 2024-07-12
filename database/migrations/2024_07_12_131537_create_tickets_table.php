<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('TicketDate');
            $table->foreignId('TypeId')->constrained('ticket_types')->cascadeOnDelete('cascade');
            $table->foreignId('StatusId')->constrained('ticket_statuses')->cascadeOnDelete();
            $table->foreignId('ContactId')->constrained('contacts')->cascadeOnDelete();
            $table->string('Subject')->nullable();
            $table->string('AgeFrom')->nullable();
            $table->string('AgeTo')->nullable();
            $table->foreignId('NationalityId')->constrained('nationalities')->cascadeOnDelete()->nullable();
            $table->foreignId('JobId')->constrained('jobs')->cascadeOnDelete();
            $table->foreignId('ReligionId')->constrained('religions')->cascadeOnDelete();
            $table->string('VisaNo')->nullable();
            $table->foreignId('VisaTypeId')->constrained('visa_types')->cascadeOnDelete();
            $table->foreignId('InsertUserId')->constrained('users')->cascadeOnDelete();
            $table->integer('Experience')->nullable();
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
        Schema::dropIfExists('tickets');
    }
};
