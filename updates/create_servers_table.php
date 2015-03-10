<?php namespace Keios\Telekinesis\Updates;

use Illuminate\Database\Schema\Blueprint;
use Schema;
use October\Rain\Database\Updates\Migration;

class CreateServersTable extends Migration
{

    public function up()
    {
        Schema::dropIfExists('keios_telekinesis_servers');
        Schema::create(
            'keios_telekinesis_servers',
            function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('ip');
                $table->integer('port')->default(22);
                $table->string('key_path')->nullable();
                $table->string('key_phrase')->nullable();
                $table->string('username')->nullable();
                $table->string('password')->nullable();
                $table->string('root')->default('/');
                $table->string('label');
                $table->timestamps();
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('keios_telekinesis_servers');
    }

}
