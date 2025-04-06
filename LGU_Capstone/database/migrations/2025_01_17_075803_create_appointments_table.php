<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->decimal('rate_per_day', 8, 2);
            $table->date('employment_start');
            $table->date('employment_end');
            $table->string('source_of_fund');
            $table->string('office_assignment');
            $table->string('appointment_type'); // To differentiate between Permanent, Temporary, Job Order
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
