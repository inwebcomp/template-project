<?php

namespace App\Admin\Resources;

use Admin\ResourceTools\Images\Images;
use Illuminate\Http\Request;
use InWeb\Admin\App\Actions\Hide;
use InWeb\Admin\App\Actions\Publish;
use InWeb\Admin\App\Contracts\Nested;
use InWeb\Admin\App\Fields\Boolean;
use InWeb\Admin\App\Fields\FastActions;
use InWeb\Admin\App\Fields\Select;
use InWeb\Admin\App\Fields\Text;
use InWeb\Admin\App\Fields\TreeField;
use InWeb\Admin\App\Filters\OnPage;
use InWeb\Admin\App\Filters\Status;
use InWeb\Admin\App\Http\Requests\AdminRequest;
use InWeb\Admin\App\Resources\Resource;
use InWeb\Admin\App\ResourceTools\ActionsOnModel;

class Navigation extends Resource implements Nested
{
    use \InWeb\Admin\App\Nested;

    protected static $position = 9;
    public static $model = \App\Models\Navigation::class;
    public static $with = ['translations'];

    public static $group = 'navigation';

    public static function label()
    {
        return __('Меню');
    }

    public static function singularLabel()
    {
        return __('Меню');
    }

    public static function uriKey()
    {
        return 'navigation';
    }

    public function title()
    {
        return $this->title;
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
            TreeField::make(__('Название'), 'title'),
            FastActions::make('')->onlyOnHover()->edit($this->editPath()),
            Text::make(__('Ссылка'), 'link', function ($value, $resource) {
                return $resource->page ? $resource->page->path() : $value;
            })->original(),
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
            Text::make(__('Название'), 'title')->link($this->editPath())->rules('required'),
            Text::make(__('Идентификатор'), 'uid'),
            Select::make(__('Ведёт на страницу'), 'page_id')
                  ->options(\App\Models\Page::ordered()->get()->map(function (\App\Models\Page $page) {
                      return [
                          'title' => $page->title,
                          'value' => $page->id,
                      ];
                  })->toArray())->withEmpty(),
            Text::make(__('Ссылка'), 'link')->size('full')->original(),
            TreeField::make(__('Родитель'), 'parent_id')->rememberParent(),
            Boolean::make('Опубликован', 'status')->default(true),

            (new Images())->accept('image/jpeg, image/png, image/svg, image/svg+xml'),
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
