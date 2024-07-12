<?php

namespace App\Providers;

use App\Nova\Agents;
use App\Nova\Airports;
use App\Nova\Cities;
use App\Nova\Contacts;
use App\Nova\ContactTypes;
use App\Nova\ContractTypes;
use App\Nova\Dashboards\Main;
use App\Nova\Jobs;
use App\Nova\Nationalities;
use App\Nova\Religions;
use App\Nova\Tickets;
use App\Nova\TicketStatus;
use App\Nova\User;
use App\Nova\VisaTypes;
use App\Nova\WorkerTransTypes;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Illuminate\Http\Request;

use Laravel\Nova\NovaApplicationServiceProvider;


class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Nova::style('style', public_path('css/style.css'));

        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('chart-bar'),


                MenuSection::make(Nova::__('ادارة  الاستقدام '), [
                    MenuItem::resource(Contacts::class),
                    MenuItem::resource(Tickets::class),
                ])->icon('desktop-computer')->collapsable(),
                MenuSection::make(Nova::__('اداة التاجير  '), [
                    MenuItem::resource(Agents::class),
                ])->icon('clock')->collapsable(),
                MenuSection::make(Nova::__('اداة نقل الكفالة  '), [
                    MenuItem::resource(Agents::class),
                ])->icon('refresh')->collapsable(),
                MenuSection::make(Nova::__('السيرية الذاتية '), [
                    MenuItem::resource(Agents::class),
                ])->icon('document-text')->collapsable(),
                MenuSection::make(Nova::__('الادارة القانونية '), [
                    MenuItem::resource(Agents::class),
                ])->icon('desktop-computer')->collapsable(),
                MenuSection::make(Nova::__('الادارة الترجمة '), [
                    MenuItem::resource(Agents::class),
                ])->icon('translate')->collapsable(),
                MenuSection::make(Nova::__('الادارة نقل الكفالة '), [
                    MenuItem::resource(Agents::class),
                ])->icon('desktop-computer')->collapsable(),
                MenuSection::make(Nova::__('الاعدادات '), [
                    MenuItem::resource(Jobs::class),
                    MenuItem::resource(Cities::class),
                    MenuItem::resource(Airports::class),
                    MenuItem::resource(Nationalities::class),
                    MenuItem::resource(ContactTypes::class),
                    MenuItem::resource(Religions::class),
                    MenuItem::resource(ContractTypes::class),
                    MenuItem::resource(VisaTypes::class),
                    MenuItem::resource(TicketStatus::class),
                    MenuItem::resource(WorkerTransTypes::class)

                ])->icon('cog')->collapsable(),

                ];
        });


    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new \Pktharindu\NovaPermissions\NovaPermissions(),
            new \Badinansoft\LanguageSwitch\LanguageSwitch(),
        ];
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
