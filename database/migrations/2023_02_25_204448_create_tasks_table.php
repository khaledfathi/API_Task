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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false); 
            $table->string('description')->nullable(true); 
            $table->date('start_date')->nullable(false); 
            $table->date('end')->nullable(false); 
            $table->enum('status',['new','in_progress','completed' , 'rejected', 'succeess'])->nullable(false); 
            $table->enum('priority',['low','medium', 'high'])->nullable(false);
            //FK
            $table->foreignId('creator_id')->nullable(true)->default(null)->references('id')->on('users')->onDelete('set null'); 
            $table->foreignId('assignee_id')->nullable(true)->default(null)->references('id')->on('users')->onDelete('set null'); 
            $table->foreignId('category_id')->nullable(true)->default(null)->references('id')->on('categories')->onDelete('set null'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
