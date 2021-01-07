<?php namespace Phuzzy\Techarea\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePhuzzyTechareaUserBantuan5 extends Migration
{
    public function up()
    {
        Schema::table('phuzzy_techarea_user_bantuan', function($table)
        {
            $table->dropColumn('fuzzy_data');
            $table->dropColumn('rekomendasi');
        });
    }
    
    public function down()
    {
        Schema::table('phuzzy_techarea_user_bantuan', function($table)
        {
            $table->text('fuzzy_data')->nullable();
            $table->integer('rekomendasi')->default(0);
        });
    }
}
