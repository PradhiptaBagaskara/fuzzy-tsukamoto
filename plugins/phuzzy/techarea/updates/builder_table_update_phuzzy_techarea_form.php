<?php namespace Phuzzy\Techarea\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePhuzzyTechareaForm extends Migration
{
    public function up()
    {
        Schema::table('phuzzy_techarea_form', function($table)
        {
            $table->integer('keluarga_sejahtera_id')->nullable();
            $table->integer('kriteria_id')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('phuzzy_techarea_form', function($table)
        {
            $table->dropColumn('keluarga_sejahtera_id');
            $table->dropColumn('kriteria_id');
        });
    }
}
