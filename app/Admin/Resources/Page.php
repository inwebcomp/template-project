<?php

namespace App\Admin\Resources;

use Admin\ResourceTools\Metadata\Metadata;
use Illuminate\Http\Request;
use InWeb\Admin\App\Actions\Hide;
use InWeb\Admin\App\Actions\Publish;
use InWeb\Admin\App\Fields\Boolean;
use InWeb\Admin\App\Fields\Editor;
use InWeb\Admin\App\Fields\Text;
use InWeb\Admin\App\Filters\OnPage;
use InWeb\Admin\App\Filters\Status;
use InWeb\Admin\App\Http\Requests\AdminRequest;
use InWeb\Admin\App\Resources\Resource;
use InWeb\Admin\App\ResourceTools\ActionsOnModel;

class Page extends Resource
{
    public static $model = \App\Models\Page::class;

    protected static $position = 10;

    public static $group = 'info';

    public static function label()
    {
        return __('Страницы');
    }

    public static function singularLabel()
    {
        return __('Страница');
    }

    public static function uriKey()
    {
        return 'page';
    }

    public function title()
    {
        return $this->title;
    }

    public function href()
    {
        return $this->path();
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param AdminRequest $request
     * @return array
     */
    public function fields(AdminRequest $request)
    {
        return [
            Text::make(__('Название'), 'title')->link($this->editPath()),
            Text::make(__('URL ID'), 'slug'),
            Boolean::make(__('Опубликован'), 'status'),
        ];
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param AdminRequest $request
     * @return array
     */
    public function creationFields(AdminRequest $request)
    {
        return [
            Text::make(__('Название'), 'title')->rules('required'),
            Text::make(__('URL ID'), 'slug'),
            Editor::make(__('Текст'), 'text'),
            Boolean::make(__('Опубликован'), 'status')->default(true),
        ];
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param AdminRequest $request
     * @return array
     */
    public function detailFields(AdminRequest $request)
    {
        return [
            Text::make(__('Название'), 'title')->rules('required'),
            Text::make(__('URL ID'), 'slug'),
            Editor::make(__('Текст'), 'text'),
            Boolean::make(__('Опубликован'), 'status')->default(true),

            new Metadata(),
            new ActionsOnModel(),
        ];
    }

    public function actions(Request $request)
    {
        return [
            new Publish(),
            new Hide(),
        ];
    }

    public function filters(Request $request)
    {
        return [
            new OnPage(20),
            new Status(),
        ];
    }
}
