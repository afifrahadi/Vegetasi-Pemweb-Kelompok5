<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vegetasi extends Model
{
    use HasFactory;
    protected $table = 'vegetasis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'code',
        'nama_vegetasi',
        'hex_code',
        ];

        protected function DescriptionLimit(): Attribute
        {
            return Attribute::make(
                get: fn (mixed $value, array $attributes) => \Str::words($attributes['nama_vegetasi'], 10, ' ...'),
            );
        }
}
