<?php

namespace App\Models;

use App\Models\Famili;
use App\Models\Classis;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ordo extends Model
{
    use HasFactory;

    protected $table = 'ordos';
    protected $primaryKey = 'id';
    protected $fillable = ['code','nama_ordo', 'deskripsi', 'fk_id_kelas'];

    protected function DescriptionLimit(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => \Str::words($attributes['dekripsi'], 10, ' ...'),
        );
    }
    
    public function classis()
    {
        return $this->belongsTo(Classis::class, 'fk_id_kelas', 'id');
    }

    public function families()
    {
        return $this->hasMany(Famili::class);
    }
}
