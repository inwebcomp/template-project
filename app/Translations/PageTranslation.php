<?php

namespace App\Translations;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use InWeb\Base\Traits\ClearsRelatedModelCache;

class PageTranslation extends Model
{
    use ClearsRelatedModelCache;

    public $timestamps = false;

    use Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
