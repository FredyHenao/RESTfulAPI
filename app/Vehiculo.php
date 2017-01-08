<?php

namespace Apis;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'tb_vehiculos';
    protected $primaryKey = 'serie';
    protected $fillable = [
        'color',
        'cilindraje',
        'potencia',
        'peso',
        'fabricante_id',
    ];
    protected $hidden = ['created_at','updated_at'];

    public function fabricantes()
    {
        //relacion de uno a uno un vehiculo tiene un fabricante
      return  $this->BelongsTo('Apis\Fabricante');
    }
}
