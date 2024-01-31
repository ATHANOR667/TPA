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
        Schema::create('particuliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('prenom');
            $table->date('date_naiss');
            $table->integer('prop_mission')->nullable();
            $table->integer('prop_acceptee')->nullable();
            $table->integer('num_tel')->unique() ;
            $table->integer('num_cni')->unique() ;
            $table->string('password')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('particuliers');
    }
};

