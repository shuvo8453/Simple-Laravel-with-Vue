<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'url',
        'status'
    ];


    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) =>  Storage::url($value),
        );
    }
}
