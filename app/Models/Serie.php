<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Serie extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'nome',
    ];

    /**
     * @var string[]
     */
    protected $appends = [
        'links',
    ];
    /**
     * @var mixed
     */

    /**
     * @return HasMany
     */
    public function episodios(): HasMany
    {
        return $this->hasMany(Episodio::class);
    }

    /**
     * @param $links
     * @return string[]
     */
    public function getLinksAttribute($links) :array
    {
        return [
            'episodios' => '/series/' . $this->id . '/episodios',
        ];
    }
}
