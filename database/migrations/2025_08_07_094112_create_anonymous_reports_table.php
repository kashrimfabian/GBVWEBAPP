<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnonymousReportsTable extends Migration
{
    public function up()
    {
        Schema::create('anonymous_reports', function (Blueprint $table) {
            $table->id('reprt_id');
            $table->text('title');
            $table->longText('description');
            $table->string('category');
            $table->string('location'); 
            $table->timestamp('submitted_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('anonymous_reports');
    }
}


