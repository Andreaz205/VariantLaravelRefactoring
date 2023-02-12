<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_variants', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->foreignId('option_id')->index()->constrained('options')->onDelete('cascade');
            $table->foreignId('variant_id')->index()->constrained('variants')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('option_variants');
    }
};
