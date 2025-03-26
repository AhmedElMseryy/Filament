<?php

use App\Traits\MigrationTrait;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    use MigrationTrait;

    public function up(): void
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->json("name")->nullable();
            $table->json("description")->nullable();
            $table->json("meta_title")->nullable();
            $table->json("meta_description")->nullable();

            $this->addGeneralFields($table);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
