<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('anonymous_report_attachments', function (Blueprint $table) {
            $table->id('rept_id');
            $table->unsignedBigInteger('report_id');
            $table->foreign('report_id')->references('reprt_id')->on('anonymous_reports')->onDelete('cascade');
            $table->string('file_path');
            $table->string('file_type');
            $table->string('original_filename')->nullable();
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('anonymous_report_attachments');
    }
};
