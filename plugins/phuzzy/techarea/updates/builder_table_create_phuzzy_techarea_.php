<?php namespace Phuzzy\Techarea\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePhuzzyTecharea extends Migration
{
    public function up()
    {
        Schema::create('phuzzy_techarea_', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('user_id');
            $table->string('gaji')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('phuzzy_techarea_');
    }
}
