<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registry extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'nome', 'telefone', 'dt_entrada', 'dt_previsao', 'responsavel_id', 'created_by'];

    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }
}
