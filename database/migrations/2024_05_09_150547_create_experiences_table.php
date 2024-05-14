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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('company');
            $table->date('start_date');
            $table->date('end_date')->nullable()->default(null);
            $table->string('location')->nullable();
            $table->string('role');
            $table->enum('type', ['Full-time', 'Part-time', 'Internship']);
            $table->text('description');
        });

        Schema::table('experiences', function (Blueprint $table) {
            $table->foreignId('resume_id')->references('id')->on('resumes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('experiences', function (Blueprint $table) {
            $table->dropForeign('experiences_resume_id_foreign');
            $table->dropColumn('resume_id');
        });
        Schema::dropIfExists('experiences');
    }
};
