<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Episodio extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'temporada',
        'numero',
        'assistido',
        'serie_id',
    ];

    /**
     * @var string[]
     */
    protected $appends = [
        'links',
    ];

    /**
     * @return BelongsTo
     */
    public function serie(): BelongsTo
    {
        return $this->belongsTo(Serie::class);
    }

    /**
     * @param $value
     * @return bool
     */
    public function getAssistidoAttribute($value) :bool
    {
        return $value;
    }

    public function getLinksAttribute($links) :array
    {
        return [
            'serie' => '/series/' . $this->serie_id,
        ];
    }
}
