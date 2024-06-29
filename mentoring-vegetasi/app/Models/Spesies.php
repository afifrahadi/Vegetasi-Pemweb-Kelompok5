<?php

namespace App\Models;

use App\Models\Genus;
use App\Models\Wilayah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spesies extends Model
{
    use HasFactory;

    protected $table = 'spesies';
    protected $primaryKey = 'id';
    protected $fillable = [
        'code',
        'nama_spesies',
        'tinggi',
        'diameter',
        'warna_daun',
        'latitude',
        'longitude',
        'deskripsi',
        'fk_id_genus',
        'fk_id_wilayah',
        'foto'];

    protected function DescriptionLimit(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => \Str::words($attributes['deskripsi'], 10, ' ...'),
        );
    }

    public function genus()
    {
        return $this->belongsTo(Genus::class, 'fk_id_genus', 'id');
    }

    public function wilayahs()
    {
        return $this->belongsTo(Wilayah::class, 'fk_id_wilayah', 'id');
    }

    protected function getFotoAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

}
