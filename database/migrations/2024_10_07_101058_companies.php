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
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('company_id');
            $table->string('company_name', 100)->nullable(false);
            $table->string('company_address', 100)->nullable(true);
            $table->string('company_email', 200)->nullable(true)->unique();
            $table->string('company_phone', 20)->nullable(true);
            $table->timestamps();
        });
    }

   
};
