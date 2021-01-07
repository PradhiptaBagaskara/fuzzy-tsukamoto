<?php namespace Phuzzy\Techarea\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePhuzzyTechareaKriteriaForm extends Migration
{
    public function up()
    {
        Schema::table('phuzzy_techarea_kriteria_form', function($table)
        {
            $table->integer('kriteria_id');
            $table->integer('form_id');
            $table->dropColumn('id_kriteria');
            $table->dropColumn('id_form');
        });
    }
    
    public function down()
    {
        Schema::table('phuzzy_techarea_kriteria_form', function($table)
        {
            $table->dropColumn('kriteria_id');
            $table->dropColumn('form_id');
            $table->integer('id_kriteria');
            $table->integer('id_form');
        });
    }
}
