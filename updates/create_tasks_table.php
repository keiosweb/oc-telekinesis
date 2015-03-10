<?php namespace Keios\Telekinesis\Updates;

use Illuminate\Database\Schema\Blueprint;
use Schema;
use October\Rain\Database\Updates\Migration;

class CreateTasksTable extends Migration
{

    public function up()
    {
        Schema::dropIfExists('keios_telekinesis_tasks');
        Schema::create(
            'keios_telekinesis_tasks',
            function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('label');
                $table->text('commands');
                $table->timestamps();
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('keios_telekinesis_tasks');
    }

}
