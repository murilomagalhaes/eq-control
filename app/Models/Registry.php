<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Registry extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'nome', 'telefone', 'dt_entrada', 'prioridade', 'dt_previsao', 'responsavel_id', 'created_by'];

    public function equipments()
    {
        return $this->hasMany(Equipment::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function responsavel(){
        return $this->belongsTo(User::class);
    }

    public function getFormatedDateTime($attr)
    {
        if ($attr === 'dt_previsao') {
            $date = Carbon::parse($this->attributes['dt_previsao']);
            return $date->format('d/m/Y');
        } else {
            $date = Carbon::parse($this->attributes['dt_entrada']);
            return $date->format('d/m/Y');
        }
    }
}
