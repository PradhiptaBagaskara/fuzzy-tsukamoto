<?php namespace Phuzzy\Techarea\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePhuzzyTechareaUserBantuan4 extends Migration
{
    public function up()
    {
        Schema::table('phuzzy_techarea_user_bantuan', function($table)
        {
            $table->integer('status')->nullable(false)->unsigned(false)->default(0)->change();
        });
    }
    
    public function down()
    {
        Schema::table('phuzzy_techarea_user_bantuan', function($table)
        {
            $table->string('status', 191)->nullable(false)->unsigned(false)->default('0')->change();
        });
    }
}
