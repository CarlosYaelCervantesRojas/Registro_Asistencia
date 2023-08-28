<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Curso;

class Docente extends Model
{
    use HasFactory;

    // public function curso(): HasOne
    // {
    //     return $this->hasOne(Curso::class);
    // }

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class);
    }

}
