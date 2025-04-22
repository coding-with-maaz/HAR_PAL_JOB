<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('job_postings', function (Blueprint $table) {
            $table->string('status')->default('active')->after('is_active');
        });

        // Update existing records
        \DB::table('job_postings')->where('is_active', true)->update(['status' => 'active']);
        \DB::table('job_postings')->where('is_active', false)->update(['status' => 'inactive']);
    }

    public function down()
    {
        Schema::table('job_postings', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}; 