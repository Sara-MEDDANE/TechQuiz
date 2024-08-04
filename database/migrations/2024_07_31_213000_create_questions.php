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
        Schema::create('questions', function (Blueprint $table) {
            $table->unsignedSmallInteger('qst_id', true);
            $table->unsignedSmallInteger('quiz_id');

            $table->string('question', 255);
            $table->timestamps();

            $table->foreign('quiz_id')  
                  ->references('quiz_id')  
                  ->on('quiz')  
                  ->onDelete('cascade')
                  ->onUpdate('cascade');            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
