<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add('Service Provider MENU');
            $event->menu->add([
                'text' => __('general.posts'),
                'icon' => 'hotel',
                'submenu' => [
                    [
                        'text' => __('general.posts_view'),
                        'url' => route('posts.index'),
                    ],
                    [
                        'text' => __('general.posts_add'),
                        'url' => route('posts.create'),

                    ],
                ],
            ]);   
            $event->menu->add([
                'text' => __('general.categories'),
                'icon' => 'hotel',
                'submenu' => [
                    [
                        'text' => __('general.categories_view'),
                        'url' => route('categories.index'),
                    ],
                    [
                        'text' => __('general.categories_add'),
                        'url' => route('categories.create'),

                    ],
                ],
            ]);          
        });
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
