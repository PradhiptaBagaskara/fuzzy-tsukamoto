<?php namespace Phuzzy\Techarea\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePhuzzyTechareaUserBantuan2 extends Migration
{
    public function up()
    {
        Schema::table('phuzzy_techarea_user_bantuan', function($table)
        {
            $table->text('fuzzy_data')->nullable()->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('phuzzy_techarea_user_bantuan', function($table)
        {
            $table->string('fuzzy_data', 191)->nullable()->unsigned(false)->default(null)->change();
        });
    }
}
