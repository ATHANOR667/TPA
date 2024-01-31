<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('professionnels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('prenom');
            $table->date('date_naiss');
            $table->integer('prop_recue')->nullable();
            $table->integer('prop_acceptee')->nullable();
            $table->integer('num_tel')->unique();
            $table->integer('num_cni')->unique();
            $table->string('password')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('experiences', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\professionnel::class)->nullable()->constrained()->cascadeOnDelete();
        });

        Schema::create('mission_particulier_professionnel', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Mission::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\particulier::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\professionnel::class)->nullable()->constrained()->cascadeOnDelete();
            $table->primary(['mission_id', 'particulier_id', 'professionnel_id']);
            $table->string('Desc_part_par_prof')->nullable();
            $table->string('Desc_prof_par_part')->nullable();
            $table->integer('note_part_par_prof')->nullable();
            $table->integer('note_prof_par_part')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professionels');
        Schema::table('experiences', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\professionel::class);
        });
        Schema::dropIfExists('mission_particulier_professionel');
    }
};
