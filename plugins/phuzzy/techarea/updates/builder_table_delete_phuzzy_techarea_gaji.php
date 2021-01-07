<?php namespace Phuzzy\Techarea\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeletePhuzzyTechareaGaji extends Migration
{
    public function up()
    {
        Schema::dropIfExists('phuzzy_techarea_gaji');
    }
    
    public function down()
    {
        Schema::create('phuzzy_techarea_gaji', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('user_id', 191);
            $table->string('gaji', 191)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
}
