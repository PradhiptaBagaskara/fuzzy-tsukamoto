<?php namespace Phuzzy\Techarea\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePhuzzyTechareaKriteria extends Migration
{
    public function up()
    {
        Schema::create('phuzzy_techarea_kriteria', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('name');
            $table->string('code');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('phuzzy_techarea_kriteria');
    }
}
