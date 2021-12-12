<?php

namespace App\Providers;

use App\Http\View\Composers\MenuComposer;
use App\Models\Page;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \InWeb\Base\Support\App::registerCacheDirectives();

        // Composers
        $this->locale();
        $this->meta();

        View::composer(['blocks.menu'], MenuComposer::class);
    }

    private function meta() : void
    {
        View::composer('layout.meta', function ($view) {
            $view->with('locale', App::getLocale());

            $indexPage = \Cache::tags(Page::cacheTagAll())->rememberForever('indexPage', function () {
                return Page::whereTranslation('slug', 'index')->first();
            });

            $data = $view->getData();

            if (! isset($data['meta']) or ! is_iterable($data['meta']) or ! isset($data['meta']['title'])) {
                $view->with('meta', ($indexPage and $indexPage->metadata) ? $indexPage->metadata->toArray() : [
                    'title' => config('app.name')
                ]);
            }
        });
    }

    private function locale() : void
    {
        View::composer(['layout.default', 'blocks.logo', 'blocks.language'], function ($view) {
            $view->with('locale', App::getLocale());
        });
    }
}
