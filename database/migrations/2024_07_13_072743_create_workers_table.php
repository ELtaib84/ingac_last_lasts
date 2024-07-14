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
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->foreignId('NationalityId')->constrained('nationalities')->cascadeOnDelete();
            $table->foreignId('ReligionId')->constrained('religions')->cascadeOnDelete();
            $table->string('BirthDate')->nullable();
            $table->string('Age')->nullable();
            $table->foreignId('JobId')->constrained('jobs')->cascadeOnDelete();
            $table->string('Passport')->nullable();
            $table->string('Phone')->nullable();
            $table->string('CV')->nullable();
            $table->string('ArriveDate')->nullable();
            $table->foreignId('AgentId')->constrained('agents')->cascadeOnDelete();
            $table->foreignId('InsertUserId')->constrained('users')->cascadeOnDelete();
            $table->foreignId('ContactId')->constrained('contacts')->cascadeOnDelete();
            $table->integer('Experience')->nullable();
            $table->integer('ExpCountry1')->default('1');
            $table->integer('ExpYears1')->default('1');
            $table->integer('ExpCountry2')->default('1');
            $table->integer('ExpYears2')->default('1');
            $table->boolean('SpeakArabic')->default('1');
            $table->boolean('CanCook')->default('1');
            $table->boolean('Massage')->default('1');
            $table->boolean('HairStylist')->default('1');
            $table->boolean('Manicure')->default('1');
            $table->boolean('EnglishTeacher')->default('1');
            $table->boolean('Nurse')->default('1');
            $table->boolean('NurseAssistance')->default('1');
            $table->integer('OtherExp')->nullable();
            $table->foreignId('TicketId')->constrained('tickets')->cascadeOnDelete();
            $table->float('Salary');
            $table->float('AgentCost');
            $table->float('RentCost');
            $table->integer('AgeRange');
            $table->float('RecruitPrice');
            $table->boolean('Active');
            $table->string('Reason')->nullable();
            $table->boolean('Arrived');
            $table->boolean('Delivered');
            $table->string('AirTicket')->nullable();
            $table->string('PassportFile')->nullable();
            $table->string('DeliveryDate');
            $table->string('Rating')->nullable();
            $table->string('BorderNo')->nullable();
            $table->string('IdNumber')->nullable();
            $table->string('IdIssueDate')->nullable();
            $table->string('IdEndDate')->nullable();
            $table->boolean('MedicalExam');
            $table->boolean('MedicalInsurance');
            $table->float('PassportFees');
            $table->float('IqamaFees');
            $table->text('Notes');
            $table->foreignId('StatusId')->constrained('worker_statuses')->cascadeOnDelete();
            $table->string('VisaNo')->nullable();
            $table->string('VisaDate')->nullable();
            $table->string('CountryEntryDate')->nullable();
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
        Schema::dropIfExists('workers');
    }
};
