<?php namespace Phuzzy\Techarea\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePhuzzyTechareaGaji extends Migration
{
    public function up()
    {
        Schema::rename('phuzzy_techarea_', 'phuzzy_techarea_gaji');
    }
    
    public function down()
    {
        Schema::rename('phuzzy_techarea_gaji', 'phuzzy_techarea_');
    }
}
