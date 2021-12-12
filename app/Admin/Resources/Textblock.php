<?php

namespace App\Admin\Resources;

use Admin\ResourceTools\Images\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

class Textblock extends Resource
{
    protected static $position = 10;
    public static $model = \App\Models\Textblock::class;
    public static $with = ['translations'];

    public static $group = 'info';

    public static function label(): string
    {
        return __('Инфо-блоки');
    }

    public static function singularLabel(): string
    {
        return __('Инфо-блок');
    }

    public static function uriKey(): string
    {
        return 'textblock';
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
            Text::make(__('Наименование'), 'title')
                ->link($this->editPath())
                ->rules('required')
                ->help(__('Название блока в админ-панели')),

            Text::make(__('Идентификатор'), 'uid')
                ->rules(['required', 'unique:textblocks'])
                ->help(__('Связывает блок с нужным местом на сайте')),

            Editor::make(__('Текст'), 'text')
                ->displayUsing(function ($value) {
                    return Str::limit(strip_tags($value), 600);
                }),

            Boolean::make(__('Опубликован'), 'status'),
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
            Text::make(__('Наименование'), 'title')
                ->link($this->editPath())
                ->rules('required')
                ->help(__('Название блока в админ-панели')),

            Editor::make(__('Текст'), 'text')
                  ->displayUsing(function ($value) {
                      return Str::limit(strip_tags($value), 600);
                  }),

            Boolean::make(__('Опубликован'), 'status'),

            new ActionsOnModel(),
            (new Images())->accept('image/jpeg, image/png, image/svg, image/svg+xml')->multiple(),
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
        return $this->fields($request);
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
