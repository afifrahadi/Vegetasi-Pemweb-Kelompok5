<?php

namespace App\Models;

use App\Models\Famili;
use App\Models\Spesies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genus extends Model
{
    use HasFactory;

    protected $table = 'genus';
    protected $primaryKey = 'id';
    protected $fillable = ['code', 'nama_genus', 'deskripsi', 'fk_id_famili', 'photo_path'];

    protected function DescriptionLimit(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => \Str::words($attributes['deskripsi'], 10, ' ...'),
        );
    }

    public function familis()
    {
        return $this->belongsTo(Famili::class, 'fk_id_famili', 'id');
    }

    public function spesies()
    {
        return $this->hasMany(Spesies::class);
    }

    protected function photoPath(): Attribute
    {
        return Attribute::make(
            get: fn (string|null $value) => $value ? asset('storage/' . $value) : $value,
        );
    }
}
