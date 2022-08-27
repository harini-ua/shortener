<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Url extends Model
{
    use SoftDeletes, HasFactory;

    public const TABLE_NAME = 'urls';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'short', 'long', 'expired_at', 'limit', 'clicks'
    ];

    protected $dates = ['expired_at'];

    /**
     * Interact with the get short url.
     *
     * @return Attribute
     */
    protected function shortUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => rtrim(env('APP_URL'),'/').'/'.$this->short,
        );
    }
}
