<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use InWeb\Base\Contracts\Cacheable;
use InWeb\Base\Traits\ClearsCache;
use InWeb\Base\Traits\Translatable;
use InWeb\Base\Contracts\HasPage;
use InWeb\Base\Entity;
use InWeb\Base\Support\Route;
use InWeb\Base\Traits\Positionable;
use InWeb\Base\Traits\TranslatableSlug;
use InWeb\Base\Traits\WithStatus;
use InWeb\Media\Images\WithContentImages;
use InWeb\Metadata\Models\Metadata;
use InWeb\Metadata\WithMetadata;
use Spatie\EloquentSortable\Sortable;

/**
 * Class Page
 *
 * @package App
 * @property string $title
 * @property string $slug
 * @property string $description
 */
class Page extends Entity implements HasPage, Sortable, Cacheable
{
    use Translatable,
        WithContentImages,
        WithStatus,
        Positionable,
        TranslatableSlug,
        ClearsCache,
        WithMetadata;

    public string $translationModel     = 'App\Translations\PageTranslation';
    public array  $translatedAttributes = ['title', 'slug', 'text'];

    protected $fillable = [
        'title',
        'slug',
        'text'
    ];

    public function path(): string
    {
        return Route::localized($this->slug);
    }

    public function getFormattedTextAttribute()
    {
        return str_replace(['<table', '</table>'], ['<div class="responsive-table"><table', '</table></div>'], $this->text);
    }
}
