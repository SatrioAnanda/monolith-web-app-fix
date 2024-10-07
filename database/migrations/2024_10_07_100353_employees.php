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
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id'); // Auto-increment primary key for employees
            $table->string('fullname', 100);
            $table->unsignedBigInteger('company_id'); // Company ID as foreign key without auto-increment
            $table->string('department', 100)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('phone', 20)->nullable();
            $table->timestamps();

            // Define foreign key for company_id
            $table->foreign('company_id')->on('companies')->references('company_id');
        });
    }
};
