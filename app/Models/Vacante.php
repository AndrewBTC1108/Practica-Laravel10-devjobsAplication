<?php

namespace App\Models;

use App\Models\Salario;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vacante extends Model
{
    use HasFactory;
    //En este caso, 'ultimo_dia' => 'date' indica que el atributo ultimo_dia debería ser tratado como un tipo de dato "date".
    protected $casts = ['ultimo_dia' => 'date'];

    protected $fillable = [
        'titulo',
        'salario_id',
        'categoria_id',
        'empresa',
        'ultimo_dia',
        'descripcion',
        'imagen',
        'publicado',
        'user_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);//pertenece a Vacante
    }
    public function salario()
    {
        return $this->belongsTo(Salario::class);
    }
    public function candidatos()
    {
        return $this->hasMany(Candidato::class)->orderBy('created_at', 'DESC');
    }

    //Onte to one, una vacante pertenece a un usuario
    //especificamos que es el user_id ya que en la tabla no hay reclutador
    //esta relacion va a ser hacia el recruiter osea la persona que creo la vacante
    public function reclutador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
