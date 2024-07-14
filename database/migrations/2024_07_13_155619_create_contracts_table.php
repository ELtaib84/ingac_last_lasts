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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('ContractCode');
            $table->foreignId('ContractTypeId')->constrained('contract_types')->cascadeOnDelete();
            $table->string('ContractDate');
            $table->string('ContractEndDate');
            $table->integer('ContractDays');
            $table->string('FileNumber');
            $table->string('VisaNo')->nullable();
            $table->foreignId('VisaTypeId')->constrained('visa_types')->cascadeOnDelete();
            $table->string('VisaDate')->nullable();
            $table->foreignId('CityId')->constrained('cities')->cascadeOnDelete();
            $table->foreignId('ContactId')->constrained('contacts')->cascadeOnDelete();
            $table->foreignId('WorkerId')->constrained('workers')->cascadeOnDelete();
            $table->text('Notes')->nullable();
            $table->string('AttachFile')->nullable();
            $table->boolean('Paid')->default(false);
            $table->string('Bank')->nullable();
            $table->string('IBAN')->nullable();
            $table->foreignId('InsertUserId')->constrained('users')->cascadeOnDelete();
            $table->integer('PeriodDays')->nullable();
            $table->float('Total')->nullable();
            $table->float('Addition')->nullable();
            $table->float('Tax')->nullable();
            $table->float('Amount')->nullable();
            $table->float('BankCost')->nullable();
            $table->float('RentAlert')->nullable();
            $table->integer('ContractPeriod')->nullable();
            $table->boolean('IsDeleted')->default(false);
            $table->foreignId('AirportId')->constrained('airports')->cascadeOnDelete();
            $table->string('AmountArabic')->nullable();
            $table->foreignId('DeliveryCityId')->constrained('cities')->cascadeOnDelete();
            $table->boolean('SalesApproval')->default(false);
            $table->boolean('FinanceApproval')->default(false);
            $table->boolean('TarjamaApproval')->default(false);
            $table->boolean('DelegateApproval')->default(false);
            $table->string('AssignNotes')->nullable();
            $table->foreignId('AssignTo')->constrained('users')->cascadeOnDelete();
            $table->longText('Signature')->nullable();
            $table->boolean('NeedReplace')->default(false);
            $table->foreignId('OldWorkerId')->constrained('workers')->cascadeOnDelete();
            $table->boolean('IsCalled')->default(false);
            $table->foreignId('ToCalledBy')->constrained('users')->cascadeOnDelete();
            $table->string('ArriveDate')->nullable();
            $table->boolean('WorkerArrived')->default(false);
            $table->string('DeliveryDate')->nullable();
            $table->boolean('WorkerDelivered')->default(false);
            $table->boolean('IsClosed')->default(false);
            $table->string('AirTicket')->nullable();
            $table->foreignId('ToDeliveredBy')->constrained('users')->cascadeOnDelete();
            $table->string('DeleteReason')->nullable();
            $table->boolean('IsQuarantinePaid')->default(false);
            $table->string('ArriveDays')->nullable();



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
        Schema::dropIfExists('contracts');
    }
};
