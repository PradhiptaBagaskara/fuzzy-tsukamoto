<?php namespace StudioBosco\LoginAsUser\Classes;

use Event;
use BackendAuth;
use Lang;
use Backend\Models\User;
use Backend\Controllers\Users;

class UserExtender
{
    public static function boot()
    {
        // Extend all backend form usage
        Event::listen('backend.form.extendFields', function($widget) {
            // Only Frontend User controller
            if (!$widget->getController() instanceof \RainLab\User\Controllers\Users) {
                return;
            }

            // Only for the User model
            if (!$widget->model instanceof \RainLab\User\Models\User) {
                return;
            }

            $user = BackendAuth::getUser();

            if (!$user->hasAccess('studiobosco.loginasuser::login')) {
                return;
            }

            $widget->addFields([
                'loginAsUser' => [
                    'type' => 'partial',
                    'path' => '$/studiobosco/loginasuser/partials/_widget_frontend_user.htm',
                    'tab' => 'rainlab.user::lang.user.account',
                ]
            ]);
        });

        Users::extendFormFields(function ($form, $model, $context) {
            if (!($model instanceOf User && $context !== 'create')) {
                return;
            }
            $user = BackendAuth::getUser();

            if (
                !$user->hasAccess('studiobosco.loginasuser::backend_login') ||
                $user->id === $model->id
            ) {
                return;
            }

            $form->addFields([
                'loginAsUser' => [
                    'type' => 'partial',
                    'path' => '$/studiobosco/loginasuser/partials/_widget_backend_user.htm',
                ]
            ]);
        });
    }
}
