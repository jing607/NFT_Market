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
        Schema::create('nfts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false);
            $table->text('description')->nullable(true);
            $table->text('contrat')->nullable(false)->unique();
            $table->enum('standard_token', ['ERC-721', 'ERC-1155', 'ERC-998']);
            $table->double('price');
            $table->string('image');

            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')
            ->references('id')
            ->on('users');

            $table->unsignedBigInteger('category_id')->index()->default(1);
            $table->foreign('category_id')
            ->references('id')
            ->on('categories');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nfts');
    }
};
