<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Factory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Factory $view)
    {
        $url = "http://www.nationalbank.kz/rss/get_rates.cfm?fdate=".date("d.m.Y");
        $xml = simplexml_load_file($url);

        $currencies = [];

        foreach($xml->item as $currency_xml)
        {
            $currencies[(string)$currency_xml->title] = $currency_xml;
        }

        $view->share('currencies', $currencies['USD']->description);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
