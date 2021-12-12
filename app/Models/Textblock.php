<?php

namespace App\Models;

use InWeb\Base\Contracts\Cacheable;
use InWeb\Base\Entity;
use InWeb\Base\Traits\ClearsCache;
use InWeb\Base\Traits\Positionable;
use InWeb\Base\Traits\WithStatus;
use InWeb\Base\Traits\WithUID;
use App\Translations\TextblockTranslation;
use \InWeb\Base\Traits\Translatable;
use InWeb\Media\Images\WithImages;
use Spatie\EloquentSortable\Sortable;

class Textblock extends Entity implements Cacheable, Sortable
{
    use Translatable,
        WithUID,
        WithStatus,
        Positionable,
        WithImages,
        ClearsCache;

    public string $translationModel     = TextblockTranslation::class;
    public array  $translatedAttributes = ['text'];

    protected $fillable = [
        'title',
        'uid',
    ];

    public static function cachedMap(): array
    {
        return \Cache::tags([Textblock::cacheTagAll()])
                     ->rememberForever(\App::getLocale() . ':textblocks', function () {
                         return self::withTranslation()->get()->mapWithKeys(function (Textblock $textblock) {
                             return [$textblock->uid => $textblock];
                         })->all();
                     });
    }

    public static function text($name): string
    {
        return strip_tags(static::html($name));
    }

    public static function unwrap($text): string
    {
        return preg_replace('/(^<p>)|(<\/p>$)/', '', $text);
    }

    public static function html($name, $withoutWrapping = false): ?string
    {
        $value = optional(static::findByUID($name))->text;

        if ($withoutWrapping)
            $value = self::unwrap($value);

        return $value;
    }

    public static function phone($name): string
    {
        $phone = str_replace([' ', '+', '(', ')', '-'], '', strip_tags(static::html($name)));

        if (!str_starts_with($phone, '373')) {
            $phone = '+373' . ltrim($phone, '0');
        }

        return $phone;
    }

    /**
     * @param string $uid
     * @param bool $force
     * @return Textblock|null
     */
    public static function findByUID(string $uid, bool $force = false): ?static
    {
        if (! $force) {
            $map = static::cachedMap();

            if (isset($map[$uid]))
                return $map[$uid];
        }

        return static::where('uid', $uid)->first();
    }
}
