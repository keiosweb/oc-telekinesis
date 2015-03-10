<?php namespace Keios\Telekinesis\Updates;

use Illuminate\Database\Schema\Blueprint;
use Schema;
use October\Rain\Database\Updates\Migration;

class CreateServersTasksTable extends Migration
{

    public function up()
    {
        Schema::dropIfExists('keios_telekinesis_servers_tasks');
        Schema::create(
            'keios_telekinesis_servers_tasks',
            function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->integer('server_id')->index()->unsigned();
                $table->integer('task_id')->index()->unsigned();
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('keios_telekinesis_servers_tasks');
    }

}
