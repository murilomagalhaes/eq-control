<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'razao', 'cpf_cnpj', 'email', 'telefone', 'cep', 'uf', 'cidade', 'endereco'
    ];

    public function registry()
    {
        return $this->belongsToMany(Registry::class);
    }
}
