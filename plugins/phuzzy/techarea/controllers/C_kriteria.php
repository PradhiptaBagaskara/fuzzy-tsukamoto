<?php namespace Phuzzy\Techarea\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class C_kriteria extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Phuzzy.Techarea', 'fuzzy-menu', 'kriteria');
    }
}
