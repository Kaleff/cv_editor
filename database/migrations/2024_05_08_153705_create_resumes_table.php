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
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('phone', 20)->nullable();
            $table->string('address')->nullable();
            $table->foreignId('author_id');
        });

        Schema::table('resumes', function (Blueprint $table) {
            $table->foreignId('author_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resumes', function (Blueprint $table) {
            $table->dropForeign('resumes_author_id_foreign');
            $table->dropIndex('resumes_author_id_index');
            $table->dropColumn('author_id');
        });
        Schema::dropIfExists('resumes');
    }
};
