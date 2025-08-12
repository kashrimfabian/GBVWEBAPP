<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('anonymous_reports', function (Blueprint $table) {
            $table->unsignedBigInteger('cat_id')->after('reprt_id');
            $table->foreign('cat_id')->references('cat_id')->on('categories')->onDelete('cascade');
           
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anonymous_reports');
    }
};
