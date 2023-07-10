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
       // class    create table name                      variable name pass
        Schema::create('calculators', function (Blueprint $table) {
            $table->id();
            $table->Integer('a');
            $table->Integer('b');
            $table->String('opr');
            $table->Integer('result');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calculators');
    }
};
