<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresentLinks extends Model
{
    use HasFactory;

    /**
     * {@inheritdoc}
     */
    protected $guarded = [
        'id', 'created_at', 'updated_at',
    ];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public function present()
    {
        return $this->belongsTo(Presents::class);
    }
}
