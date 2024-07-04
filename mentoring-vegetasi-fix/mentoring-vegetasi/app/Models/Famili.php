<?php

namespace App\Models;

use App\Models\Ordo;
use App\Models\Genus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Famili extends Model
{
    use HasFactory;

    protected $table = 'familis';
    protected $primaryKey = 'id';
    protected $fillable = ['code','nama_famili', 'deskripsi', 'fk_id_ordo'];

    protected function DescriptionLimit(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => \Str::words($attributes['dekripsi'], 10, ' ...'),
        );
    }

    public function ordos()
    {
        return $this->belongsTo(Ordo::class, 'fk_id_ordo', 'id');
    }

    public function genues()
    {
        return $this->hasMany(Genus::class);
    }
}
