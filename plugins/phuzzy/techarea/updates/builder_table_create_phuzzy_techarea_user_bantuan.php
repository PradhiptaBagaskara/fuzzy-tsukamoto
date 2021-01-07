<?php namespace Phuzzy\Techarea\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePhuzzyTechareaUserBantuan extends Migration
{
    public function up()
    {
        Schema::create('phuzzy_techarea_user_bantuan', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->boolean('answered')->default(0);
            $table->string('status')->default(0);
            $table->string('fuzzy_data')->nullable();
            $table->integer('user_id')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('phuzzy_techarea_user_bantuan');
    }
}
