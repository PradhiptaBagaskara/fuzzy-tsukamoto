<?php namespace Phuzzy\Techarea\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePhuzzyTechareaFormUser extends Migration
{
    public function up()
    {
        Schema::create('phuzzy_techarea_form_user', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('user_id')->nullable();
            $table->integer('form_id')->nullable();
            $table->string('value')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('phuzzy_techarea_form_user');
    }
}
