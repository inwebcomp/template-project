<?php

namespace App\Models;

use InWeb\Base\Contracts\Cacheable;
use InWeb\Base\Contracts\HasPage;
use InWeb\Base\Contracts\Nested;
use InWeb\Base\Entity;
use InWeb\Base\Support\Route;
use InWeb\Base\Traits\ClearsCache;
use InWeb\Base\Traits\Positionable;
use InWeb\Base\Traits\WithStatus;
use InWeb\Base\Traits\WithUID;
use \InWeb\Base\Traits\Translatable;
use InWeb\Media\Images\WithImages;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\EloquentSortable\Sortable;

/**
 * Class Navigation
 * @package App\Models
 * @property string $title
 * @property Page $page
 * @property string|null $link
 */
class Navigation extends Entity implements Nested, Sortable, Cacheable, HasPage
{
    use Translatable,
        WithUID,
        WithStatus,
        WithImages,
        Positionable,
        NodeTrait,
        ClearsCache;

    public string $translationModel     = 'App\Translations\NavigationTranslation';
    public array  $translatedAttributes = ['title', 'link'];

    protected $fillable = [
        'title',
        'parent_id',
    ];

    public function getTable(): string
    {
        return 'navigation';
    }

    public function getLinkAttribute($value): string
    {
        return $this->page ? $this->page->path() : ($value ? Route::localized($value) : '/');
    }

    public function page(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function path(): string
    {
        return $this->link;
    }
}
