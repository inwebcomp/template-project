<?php

namespace App\Translations;

use Illuminate\Database\Eloquent\Model;
use InWeb\Base\Traits\ClearsRelatedModelCache;

class TextblockTranslation extends Model
{
    use ClearsRelatedModelCache;

    public $timestamps = false;

    protected $fillable = [
        'text',
    ];
}
