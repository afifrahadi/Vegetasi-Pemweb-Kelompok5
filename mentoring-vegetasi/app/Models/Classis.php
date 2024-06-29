<?php

namespace App\Models;

use App\Models\Ordo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classis extends Model
{
    use HasFactory;
    // protected $table = 'classes';
    protected $fillable = ['code', 'name', 'description'];

    protected function DescriptionLimit(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => \Str::words($attributes['description'], 10, ' ...'),
        );
    }

    public function ordoes()
    {
        return $this->hasMany(Ordo::class);
    }

}
