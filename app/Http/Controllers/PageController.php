<?php

namespace App\Http\Controllers;

use App\Breadcrumbs;
use App\Models\Navigation;
use App\Models\Page;
use App\Models\Textblock;

class PageController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }

    public function show($page)
    {
        /** @var Page $page */
        $page = Page::findBySlug($page)->published()->firstOrFail();

        if ($page->slug == 'index')
            return abort(404);

        $render = function () use ($page) {
            return view('pages.text', [
                'page'        => $page,
                'breadcrumbs' => Breadcrumbs::page($page),
                'pageTitle'   => $page->title,
                'meta'        => $page->getMetadata(),
            ])->render();
        };

        if (auth()->guard('admin')->check())
            return $render();

        return \Cache::tags([Page::cacheTagAll(), $page->cacheTag()])
                     ->rememberForever(\App::getLocale() . ':page:' . $page->id, $render);
    }
}
