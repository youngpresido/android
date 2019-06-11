<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1558098733LecturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('lecturers')) {
            Schema::create('lecturers', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->string('school')->nullable();
                $table->integer('account_number')->nullable();
                $table->string('email')->nullable();
                $table->string('bank')->nullable();
                $table->string('department')->nullable();
                $table->string('referer_code')->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lecturers');
    }
}
