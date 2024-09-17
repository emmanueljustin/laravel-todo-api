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
        Schema::create('todos', function (Blueprint $table) {
            $table->id()->primary();
            $table->unsignedBigInteger('owner_id');
            $table->foreign("owner_id")->constrained()->references('id')->on('authentication')->onDelete('cascade');
            $table->timestamps();
            $table->string("title")->nullable();
            $table->string("content")->nullable();
            $table->integer("priority_level");
            $table->boolean("is_finished")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
