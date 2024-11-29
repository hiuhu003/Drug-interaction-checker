<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class  CreateDrugInteractionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('drug_interactions', function (Blueprint $table) {
            $table->id();
            $table->string('drug1');
            $table->string('drug2');
            $table->text('side_effects')->nullable();
            $table->text('dosage_guidance')->nullable();
            $table->text('overdose_response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drug_interactions');
    }
};
