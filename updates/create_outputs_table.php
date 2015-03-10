<?php namespace Keios\Telekinesis\Updates;

use Illuminate\Database\Schema\Blueprint;
use Schema;
use October\Rain\Database\Updates\Migration;

class CreateOutputsTable extends Migration
{

    public function up()
    {
        Schema::dropIfExists('keios_telekinesis_outputs');
        Schema::create(
            'keios_telekinesis_outputs',
            function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->integer('server_id')->index()->unsigned();
                $table->integer('task_id')->index()->unsigned();
                $table->mediumText('output');
                $table->timestamps();
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('keios_telekinesis_outputs');
    }

}
