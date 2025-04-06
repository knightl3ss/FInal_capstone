<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('personnels', function (Blueprint $table) {
        $table->id();
        $table->string('itemNo');
        $table->string('position');
        $table->string('salaryGrade');
        $table->string('authorizedSalary');
        $table->string('actualSalary');
        $table->string('step');
        $table->string('code');
        $table->string('type');
        $table->string('level');
        $table->string('lastName');
        $table->string('firstName');
        $table->string('middleName')->nullable();
        $table->date('dob');
        $table->date('originalAppointment');
        $table->date('lastPromotion')->nullable();
        $table->string('status');
        $table->timestamps();
    });
}
};