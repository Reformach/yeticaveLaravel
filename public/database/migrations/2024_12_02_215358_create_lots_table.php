<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lots', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('url');
            $table->decimal('price');
            $table->decimal('bet_step');
            $table->timestamp('end_date');
            $table->timestamp('creation_date')->default(now());
            $table->foreignId('category_id')->constrained();
            $table->foreignId('author_id')->constrained('users');
            $table->foreignId('winner_id')->nullable()->constrained('users');
        });
        DB::statement('ALTER TABLE lots ADD FULLTEXT fulltext_index (title,description)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lots');
    }
};
