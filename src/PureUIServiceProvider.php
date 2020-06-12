<?php

namespace QCute\PureUI;

use Encore\Admin\Admin;
use Illuminate\Support\ServiceProvider;

class PureUIServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(PureUI $extension)
    {
        if (!PureUI::boot())
            return;

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes([$assets => public_path('vendor/laravel-admin-ext/pure-ui/')], 'laravel-admin-pure-ui');
        }

        Admin::booting(function () {
            Admin::js('vendor/laravel-admin-ext/pure-ui/PureAdminLTE/dist/js/pure.ui.min.js');
            Admin::css('vendor/laravel-admin-ext/pure-ui/PureAdminLTE/dist/css/pure.ui.min.css');
        });
    }
}
