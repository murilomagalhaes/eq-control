<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Registry extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'nome',
        'telefone',
        'dt_entrada',
        'prioridade',
        'dt_entrega',
        'dt_previsao',
        'updated_by',
        'procedimentos',
        'responsavel_id',
        'created_by'
    ];

    protected $dates = ['dt_entrega', 'dt_previsao', 'dt_entrada'];

    public function equipments()
    {
        return $this->hasMany(Equipment::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function responsavel()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormatedDateTime(string $attr)
    {
        if ($attr === 'dt_previsao' && $this->attributes['dt_previsao']) {
            $date = Carbon::parse($this->attributes['dt_previsao']);
            return $date->format('d/m/Y H:i');
        } else if ($attr === 'dt_entrada' && $this->attributes['dt_entrada']) {
            $date = Carbon::parse($this->attributes['dt_entrada']);
            return $date->format('d/m/Y H:i');
        } else if ($attr === 'dt_entrega' && $this->attributes['dt_entrega']) {
            $date = Carbon::parse($this->attributes['dt_entrega']);
            return $date->format('d/m/Y H:i');
        }

        return null;
    }

    public function isOverDue(): bool
    {
        if (!$this->attributes['dt_previsao'] && !$this->attributes['dt_entrega']) {
            return false;
        }
        
        $previsao = $this->attributes['dt_previsao'] ?? 0;

        if (Carbon::parse($previsao)->lt(now()) && !$this->attributes['dt_entrega']) {
            return true;
        }

        return false;
    }
}
