<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('job_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('job_posting_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_posting_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_tag_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['job_posting_id', 'job_tag_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_posting_tag');
        Schema::dropIfExists('job_tags');
    }
}; 