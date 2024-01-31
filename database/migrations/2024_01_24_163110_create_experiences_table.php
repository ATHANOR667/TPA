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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('fonction');
            $table->date('debut');
            $table->date('fin');
            $table->integer('remuneration');
            $table->string('desc_rem');
            $table->string('qualification');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
