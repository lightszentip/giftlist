<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresentLinks extends Model
{
    use HasFactory;

    public function present()
    {
        return $this->belongsTo(Presents::class);
    }
}
