<?php

namespace Ricardo\Modu\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesion extends Model
{
    use HasFactory;

    public function scopeProfesionsUser($query, $idUser)
    {
    	return $query
    		->select('cup_id')
    		->where('user_id', $idUser)
    		->get();
    }

    public function scopeProfesionUser($query, $idUser, $idCup)
    {
    	return $query
    		->select(
    			'profesions.id',
    			'cups.codigo',
    			'cups.cup'
    		)
    		->join('cups', 'cups.id', 'profesions.cup_id')
    		->where('profesions.user_id', $idUser)
    		->where('profesions.cup_id', $idCup)
    		->get()
    		->first();
    }
}
