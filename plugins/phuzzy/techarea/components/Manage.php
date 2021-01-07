<?php namespace Phuzzy\Techarea\Components;

use Lang;
use Auth;
use Mail;
use Event;
use Flash;
use Input;
use Request;
use Redirect;
use Validator;
use ValidationException;
use ApplicationException;
use October\Rain\Auth\AuthException;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use RainLab\User\Models\User as UserModel;
use RainLab\User\Models\Settings as UserSettings;
use Phuzzy\Techarea\Models\Form;
use Phuzzy\Techarea\Models\UserForm;
use Phuzzy\Techarea\Models\Kriteria;
use Phuzzy\Techarea\Models\Sejahtera;
use Phuzzy\Techarea\Models\Bantuan;
use Exception;

/**
 * Account component
 *
 * Allows users to register, sign in and update their account. They can also
 * deactivate their account and resend the account verification email.
 */
class Manage extends ComponentBase
{
    protected $user;
    public function componentDetails()
    {
        return [
            'name'        => 'Manager Component',
            'description' => /*User management form.*/'return list'
        ];
    }

    public function defineProperties()
    {

    }

    /**
     * Executed when this component is initialized
     */
    public function prepareVars()
    {
        $this->user = Auth::getUser();
        $this->page['userList'] = UserModel::where('id', '!=', $this->user->id)->get();
   
    }

    /**
     * Executed when this component is bound to a page or layout.
     */
    public function onRun()
    {
        $this->prepareVars();

    }




}
