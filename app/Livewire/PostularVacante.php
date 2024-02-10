<?php

namespace App\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{
    //habilitar la carga de archivos
    use WithFileUploads;

    public $cv;
    public $vacante;

    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];

    //mount es una funcion que se va a ejecutar automaticamnete una ves instanciado el posts(es como un constructor en php)
    public function mount(Vacante $vacante)
    {
        $this->vacante = $vacante;
    }

    public function postularme()
    {
        //llamar las reglas de validacion
        $datos = $this->validate();

        // validar que el usuario no haya postulado a la vacante
        if($this->vacante->candidatos()->where('user_id', auth()->user()->id)->count() > 0) {
            //Mostrar al usuario un mensaje de ok
            session()->flash('error', 'Ya te has postulado a esta vacante anteriormente');
        } else{
            //Almacenar CV en el disco duro
            //Almacenar la Imagen
            $cv = $this->cv->store('/public/cv');
            $datos['cv'] = str_replace('public/cv/', '', $cv);

            //Crear el candidato a la vacante
            //al hacer la relacion ya sabe cual vacante id es asi que no hay necesidad de colocarlo en dentro del crate
            $this->vacante->candidatos()->create([
                'user_id' => auth()->user()->id,
                'cv' => $datos['cv']
            ]);


            //Crear notificacion y enviar el Email
            //se crea con la relacion de reclutador, toma como parametro la ntorificacion que se quiere enviar, en este caso NuevoCandidato
            //toma 3 parametros, el id de a vacante, el titulo de la vacante y por ultimo el id del usuario que se va a postular a la vacante
            $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id));

            //Mostrar al usuario un mensaje de ok
            session()->flash('mensaje', 'Se envio correctamente tu informacion, mucha suerte');
            return redirect()->back();
        }
    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
