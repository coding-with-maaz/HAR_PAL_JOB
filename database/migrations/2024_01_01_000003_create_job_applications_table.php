<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_posting_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('resume')->nullable();
            $table->text('cover_letter')->nullable();
            $table->json('answers')->nullable(); // For custom application questions
            $table->string('status')->default('pending'); // pending, reviewed, shortlisted, rejected, hired
            $table->text('notes')->nullable(); // Internal notes
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Add indexes for performance
            $table->index('status');
            $table->unique(['job_posting_id', 'user_id']); // Prevent duplicate applications
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_applications');
    }
}; 