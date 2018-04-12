<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumeTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resume_token', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('resume_id');
            $table->string('key');
            $table->timestamps();

            $table->foreign('resume_id')
                ->references('id')
                ->on('resumes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resume_token', function (Blueprint $table) {
            $table->dropForeign('resume_token_resume_id_foreign');
        });

        Schema::dropIfExists('resume_token');
    }
}
