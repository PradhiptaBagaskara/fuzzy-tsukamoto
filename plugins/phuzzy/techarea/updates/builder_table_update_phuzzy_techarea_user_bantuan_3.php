<?php namespace Phuzzy\Techarea\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePhuzzyTechareaUserBantuan3 extends Migration
{
    public function up()
    {
        Schema::table('phuzzy_techarea_user_bantuan', function($table)
        {
            $table->boolean('bantuan')->default(0);
            $table->integer('rekomendasi')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('phuzzy_techarea_user_bantuan', function($table)
        {
            $table->dropColumn('bantuan');
            $table->dropColumn('rekomendasi');
        });
    }
}
