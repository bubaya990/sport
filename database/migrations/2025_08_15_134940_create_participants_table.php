<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone')->nullable();
            $table->text('adresse')->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('nationalite')->nullable();
            $table->string('wilaya')->nullable();
            $table->string('email')->nullable();
            $table->enum('sexe', ['homme', 'femme'])->nullable();
            $table->enum('taille_maillot', ['S', 'M', 'L', 'XL', 'XXL'])->nullable();
            $table->string('club')->nullable();
            $table->enum('affilie_federation', ['oui', 'non'])->default('non');
            $table->string('numero_licence')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};