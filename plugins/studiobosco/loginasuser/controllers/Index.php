<?php namespace StudioBosco\LoginAsUser\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Input;
use Auth;
use BackendAuth;
use Redirect;
use RainLab\User\Models\User as FrontendUser;
use Backend\Models\User as BackendUser;

/**
 * Login As User Back-end Controller
 */
class Index extends Controller
{

    public $requiredPermissions = ['studiobosco.loginasuser.*'];

    public function index()
    {
        $frontendUser = null;
        $backendUser = null;
        $frontendUserId = Input::get('frontend_user_id');
        $backendUserId = Input::get('backend_user_id');
        $this->vars['user'] = null;
        $this->pageTitle = 'Login as User';

        if ($frontendUserId) {
            try {
                $this->vars['user'] = $frontendUser = FrontendUser::find($frontendUserId);
            } catch (\Exception $error) {

            }
        } elseif ($backendUserId) {
            try {
                $this->vars['user'] = $backendUser = BackendUser::find($backendUserId);
            } catch (\Exception $error) {

            }
        }

        if ($frontendUser && $frontendUser->is_activated) {
            Auth::login($frontendUser, true);
        } elseif ($backendUser) {
            BackendAuth::login($backendUser, true);
            return Redirect::to('/backend');
        }
    }
}
