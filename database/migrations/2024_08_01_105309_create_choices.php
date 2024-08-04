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
        Schema::create('choices', function (Blueprint $table) {
            $table->unsignedSmallInteger('choice_id', true);  //PK
            $table->unsignedSmallInteger('qst_id');        //FK

            $table->string('choice', 200);
            $table->boolean('is_correct');
            $table->timestamps();


            $table->foreign('qst_id')  
                  ->references('qst_id')  
                  ->on('questions')  
                  ->onDelete('cascade')
                  ->onUpdate('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('choices');
    }
};
