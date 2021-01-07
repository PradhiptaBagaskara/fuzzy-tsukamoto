<?php

namespace Phuzzy\Techarea\Classes;

use Phuzzy\Techarea\Models\Rule;

/**
* Phuzzy CLass
*/
class Tsukamoto 
{

    public static function tsuka($inputName=[])
    {
        $phuzzy = new Phuzzy;
        $result = [];

		$phuzzy->clearMembers();
		
        $getInput = [];
        foreach ($inputName as $key => $data) {
            $getInput[] = $data['name']; 
        }
		
        $phuzzy->setInputNames($getInput);
        foreach ($inputName as $n) {
            $phuzzy->addMember($n['name'], 'buruk',  0, 30, 60, 'LEFT_INFINITY');
            $phuzzy->addMember($n['name'], 'baik', 50, 80, 100, 'RIGHT_INFINITY');
        }  

	
		$phuzzy->SetOutputNames(['bantuan']);

		$phuzzy->addMember('bantuan', 'tidak',  0, 30, 49, 'LEFT_INFINITY');
        $phuzzy->addMember('bantuan', 'dapat', 50, 80, 100, 'RIGHT_INFINITY');
        
        $result['members'] = $phuzzy->getMembers();

        $phuzzy->clearRules();

        $rule = Rule::all();
        foreach ($rule as $key => $value) {
            $phuzzy->addRule($value->rule); //R1s
        }

        foreach ($inputName as $nj => $vj) {
            $nama =$vj['name'];
            $val = (float)$vj['value'];
            $phuzzy->setRealInput($nama, $val);
            
            # code...
        }
        

        $result['realInput'] = $phuzzy->RRealInput; 
        $result['rules'] = $phuzzy->getRules();
        $result['tsukamoto'] = $phuzzy->Execute();
        return $result;
    }
}
