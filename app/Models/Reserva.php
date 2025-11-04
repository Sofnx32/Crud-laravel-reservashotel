<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';

    protected $fillable = [
        'habitacion',
        'precio',
        'disponible',
        'tipo',
        'fecha_entrada',
        'fecha_salida',
        'estado',
        'cliente_id',
    ];

    protected $casts = [
        'disponible' => 'boolean',
        'fecha_entrada' => 'date',
        'fecha_salida' => 'date',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
