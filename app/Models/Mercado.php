<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mercado extends Model
{
    use HasFactory;


    protected $fillable = [
        'nome',
        'descricao'
    ];


    public function produtos()
    {
        return $this->belongsToMany(Produto::class);
    }

}