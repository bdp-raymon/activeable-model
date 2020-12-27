<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActiveableModelsTable extends Migration
{
    public function up()
    {
        Schema::create('activeable_models', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active');
            $table->json('payload')->nullable();
            $table->string('object_type');
            $table->unsignedBigInteger('object_id');
            $table->dateTime('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('activeable_models');
    }
}
