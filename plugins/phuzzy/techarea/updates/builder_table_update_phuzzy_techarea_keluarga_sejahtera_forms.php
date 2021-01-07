<?php namespace Phuzzy\Techarea\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePhuzzyTechareaKeluargaSejahteraForms extends Migration
{
    public function up()
    {
        Schema::table('phuzzy_techarea_keluarga_sejahtera_forms', function($table)
        {
            $table->integer('form_id')->nullable();
            $table->integer('keluarga_sejahtera_id')->nullable();
            $table->dropColumn('id_form');
            $table->dropColumn('id_keluarga_sejahtera');
        });
    }
    
    public function down()
    {
        Schema::table('phuzzy_techarea_keluarga_sejahtera_forms', function($table)
        {
            $table->dropColumn('form_id');
            $table->dropColumn('keluarga_sejahtera_id');
            $table->integer('id_form');
            $table->integer('id_keluarga_sejahtera');
        });
    }
}
