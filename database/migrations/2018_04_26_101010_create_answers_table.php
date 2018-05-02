<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('answer')->nullable()->default(null);
            $table->string('applicant_id',10);
            $table->string('question_id',10);
            $table->string('time_taken',3)->nullable()->default(null);
            $table->tinyInteger('right')->default(0)->comment('0=wrong, 1=right answer');
            $table->unique(['applicant_id', 'question_id']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
