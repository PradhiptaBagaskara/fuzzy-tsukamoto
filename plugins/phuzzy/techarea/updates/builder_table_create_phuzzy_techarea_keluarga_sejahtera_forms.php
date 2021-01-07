<?php namespace Phuzzy\Techarea\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePhuzzyTechareaKeluargaSejahteraForms extends Migration
{
    public function up()
    {
        Schema::create('phuzzy_techarea_keluarga_sejahtera_forms', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('id_form');
            $table->integer('id_keluarga_sejahtera');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('phuzzy_techarea_keluarga_sejahtera_forms');
    }
}
