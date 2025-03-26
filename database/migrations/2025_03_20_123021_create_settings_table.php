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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string("email")->nullable();
            $table->string("phone")->nullable();
            $table->string("phone2")->nullable();
            $table->string("support_phone")->nullable();
            $table->string("location")->nullable();
            $table->string("facebook")->nullable();
            $table->string("x")->nullable();
            $table->string("instagram")->nullable();
            $table->string("whatsapp")->nullable();
            $table->string("youtube")->nullable();
            $table->string("tiktok")->nullable();

            $table->json("name")->nullable();
            $table->json("description")->nullable();
            $table->json("notes_and_suggestions")->nullable();
            $table->json("footer_description")->nullable();
            $table->json("footer_description2")->nullable();

            $this->addGeneralFields($table);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
