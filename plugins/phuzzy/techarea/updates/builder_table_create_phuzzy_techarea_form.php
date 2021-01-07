<?php namespace Phuzzy\Techarea\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePhuzzyTechareaForm extends Migration
{
    public function up()
    {
        Schema::create('phuzzy_techarea_form', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->text('form');
            $table->text('value');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('phuzzy_techarea_form');
    }
}
