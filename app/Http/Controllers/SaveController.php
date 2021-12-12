<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (! Auth::guard('admin')->check())
                return abort(422);

            return $next($request);
        });
    }

    public function handle(Request $request, $resource, $resourceId)
    {
        $value = $request->input('value');

        $entity = $this->getEntity($resource, $resourceId);

        $entity->text = $value;
        $entity->save();

        return __('Данные сохранены');
    }

    public function getEntity($resource, $resourceId)
    {
        $class = match ($resource) {
            'page' => null,
        };

        return $class::findOrFail($resourceId);
    }
}
