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

        $vendor_path = 'vendor/laravel-admin-ext/pure-ui/';

        if ($this->app->runningInConsole() && $assets = $extension->assets())
            $this->publishes([$assets => public_path($vendor_path)], 'laravel-admin-pure-ui');

        Admin::booting(function () use ($vendor_path) {
            array_push(Admin::$baseCss, $vendor_path . 'PureAdminLTE/dist/css/pure.ui.min.css');
            array_push(Admin::$baseJs, $vendor_path . 'PureAdminLTE/dist/js/pure.ui.min.js');
        });
    }
}
