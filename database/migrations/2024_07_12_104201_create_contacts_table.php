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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ContactTypeId')->constrained('contact_types')->onDelete('cascade');
            $table->string('Name');
            $table->string('Email')->nullable();
            $table->string('Phone')->nullable();
            $table->foreignId('NationalityId')->constrained('nationalities')->onDelete('cascade');
            $table->string('IdNumber');
            $table->string('IdIssueFrom');
            $table->string('Profession')->nullable();
            $table->string('BirthDate')->nullable();
            $table->integer('Age')->nullable();
            $table->foreignId('CityId')->constrained('cities')->onDelete('cascade');
            $table->string('Address')->nullable();
            $table->string('Notes')->nullable();
            $table->integer('RelatePhone')->nullable();
            $table->string('RelateName')->nullable();
            $table->string('RelateEmail')->nullable();
            $table->string('RelateType')->nullable();
            $table->foreignId('InsertUserId')->constrained('users')->onDelete('cascade');
            $table->foreignId('UpdateUserId')->constrained('users')->onDelete('cascade');
            $table->integer('BlackList')->default(0);
            $table->text('StopReason')->nullable();
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
        Schema::dropIfExists('contacts');
    }
};
