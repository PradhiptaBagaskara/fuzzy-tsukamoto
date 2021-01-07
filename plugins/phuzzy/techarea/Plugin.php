<?php namespace Phuzzy\Techarea;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            \Phuzzy\Techarea\Components\Fuzzy::class       => 'fuzzy',
            \Phuzzy\Techarea\Components\Manage::class       => 'manage',
            // \Phuzzy\Techarea\Components\Account::class       => 'account',
            // \Phuzzy\Techarea\Components\ResetPassword::class => 'resetPassword'
        ];
    }

    public function registerSettings()
    {
    }
}
