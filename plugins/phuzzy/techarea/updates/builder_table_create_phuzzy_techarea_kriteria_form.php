<?php namespace Phuzzy\Techarea\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePhuzzyTechareaKriteriaForm extends Migration
{
    public function up()
    {
        Schema::create('phuzzy_techarea_kriteria_form', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('id_kriteria');
            $table->integer('id_form');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('phuzzy_techarea_kriteria_form');
    }
}
