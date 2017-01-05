<?php

namespace Apis;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'tb_vehiculo';
    protected $primaryKey = 'serie';
    protected $fillable = [
        'color',
        'cilindraje',
        'potencia',
        'peso',
        'fabricante_id',
    ];

    public function fabricantes()
    {
        //relacion de uno a uno un vehiculo tiene un fabricante
        $this->BelongsTo('Fabricante');
    }
}
