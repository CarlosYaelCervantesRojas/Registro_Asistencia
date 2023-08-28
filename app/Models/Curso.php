<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Docente;
use Illuminate\Contracts\Hashing\Hasher;

class Curso extends Model
{
    use HasFactory;

    // public function docente(): BelongsTo
    // {
    //     return $this->belongsTo(Docente::class);
    // }

    public function docente(): HasOne
    {
        return $this->hasOne(Docente::class);
    }

    public function alumnos(): HasMany
    {
        return $this->hasMany(Alumno::class);
    }

}
