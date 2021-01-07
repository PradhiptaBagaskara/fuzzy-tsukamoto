<?php namespace Phuzzy\Techarea\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Phuzzy\Techarea\Models\Bantuan as Model;
use Phuzzy\Techarea\Models\UserForm;


class Bantuan extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Phuzzy.Techarea', 'bantuan');

    }

    public function formExtendFields($form)
    {
        if (!$this->user->hasAccess('edit.bantuan')) {
            $form->addFields([
                'status' => [
                    'type' => 'text',
                    'hidden' => 'true'
                ],
                'bantuan' => [
                    'type' => 'text',
                    'hidden' => 'true'
                ],
            ]);
        }
    }

    public function getBantuan()
    {
        $id = $this->params[0];
        $m = Model::with('form')
                    ->with('user')
                    ->find($id);
        return $m;
    }


    public function getFuzzy()
    {
       return Model::getFuzzy($this->vars['formModel']->user_id);
    }
}
