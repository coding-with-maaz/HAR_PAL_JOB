<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('requirements')->nullable();
            $table->text('responsibilities')->nullable();
            $table->string('location');
            $table->string('employment_type'); // full-time, part-time, contract, internship
            $table->string('experience_level'); // entry, mid, senior
            $table->decimal('salary_min', 12, 2)->nullable();
            $table->decimal('salary_max', 12, 2)->nullable();
            $table->string('department')->nullable();
            $table->boolean('remote_allowed')->default(false);
            $table->boolean('easy_apply')->default(false);
            $table->json('skills_required')->nullable();
            $table->json('benefits')->nullable();
            $table->date('application_deadline')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('posted_by')->constrained('users')->onDelete('cascade');
            $table->integer('views_count')->default(0);
            $table->integer('applications_count')->default(0);
            $table->timestamps();
            $table->softDeletes();

            // Add indexes for search performance
            $table->index('title');
            $table->index('location');
            $table->index('employment_type');
            $table->index('department');
            $table->index('experience_level');
            $table->index('remote_allowed');
            $table->index('is_active');
            $table->index(['is_active', 'created_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_postings');
    }
}; 