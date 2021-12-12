<?php

namespace App\Http\View\Composers;

use App\Models\Navigation;
use Illuminate\View\View;

class MenuComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $menu = Navigation::findByUID('menu');

        if ($menu) {
            $menu = $menu->children()
                 ->published()
                 ->ordered()
                 ->withTranslation()
                 ->get();
        }

        $view->with('menu', $menu);
    }
}