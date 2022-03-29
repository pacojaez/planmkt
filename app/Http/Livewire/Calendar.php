<?php

namespace App\Http\Livewire;

use App\Models\Record;
use Livewire\Component;
use Illuminate\Support\Collection;

class Calendar extends Component
{
    /*
    *propiedad relacionada con los registros de la DB
    */
    public $records;

    /**
     * Listener para remover un registro de la DB
     */
    protected $listeners = ['recordRemoved' => 'recordRemoved'];

    /**
     * Undocumented function
     *
     * @param boolean $recordClickEnabled
     * @param array $extras
     * @return void
     */
    public function mount($recordClickEnabled = false,$extras = [])
    {
        $statuses = [1,2,3];

        $this->recordClickEnabled = $recordClickEnabled ?? false;

        $this->afterMount($extras);

        $this->records = Record::all();
    }

    // public function hydrate(){
    //     $records = $this->records();
    // }

    public function afterMount($extras = [])
    {
        //
    }
    /**
     * Collection de status para pruebas, podría sacarse de una tabla de la DB
     *
     * @return Collection
     */
    public function statuses() : Collection
    {
        return collect([
            [
                'id' => '1',
                'title' => 'Lunes',
            ],
            [
                'id' => '2',
                'title' => 'Martes',
            ],
            [
                'id' => '3',
                'title' => 'Miercoles',
            ],
            [
                'id' => '4',
                'title' => 'Jueves',
            ],
            [
                'id' => '5',
                'title' => 'Viernes',
            ],
            [
                'id' => '6',
                'title' => 'Sábado',
            ],
            [
                'id' => '7',
                'title' => 'Domingo',
            ],
        ]);
    }

    /**
     * Collection de turnos para pruebas, podría sacarse de una tabla de la DB
     *
     * @return Collection
     */
    public function turnos() : Collection
    {

        $horas = [];
        for( $i= 1; $i<25; $i++){
            if($i < 10)
                $horas[$i] = [ 'id' => '0'.$i, 'title' => '0'.$i];
            else
                $horas[$i] = [ 'id' => $i, 'title' => $i];
        }

        return collect( $horas );
    }

    /**
     * Collection de empleados para pruebas, podría sacarse de una tabla de la DB
     *
     * @return Collection
     */
    public function empleados() : Collection
    {
        //traemos los empleados de la base de datos
        //en esta versión simplemente tenemos un array de 15 empleados
        //para generar el primer draggable de la funcionalidad

        return collect([
            [
                'id' => '1',
                'empleado' => 'FB post',
                'rs' => 'Facebook',
                'content' => 'Post'
            ],
            [
                'id' => '2',
                'empleado' => 'IG Post',
                'rs' => 'Instagram',
                'content' => 'Post'
            ],
            [
                'id' => '3',
                'empleado' => 'FB Storie',
                'rs' => 'Facebook',
                'content' => 'Storie'
            ],
            [
                'id' => '4',
                'empleado' => 'IG Storie',
                'rs' => 'Instagram',
                'content' => 'Storie'
            ],
            [
                'id' => '5',
                'empleado' => 'FB Reel',
                'rs' => 'Facebook',
                'content' => 'Reel'
            ],
            [
                'id' => '6',
                'empleado' => 'IG Reel',
                'rs' => 'Instagram',
                'content' => 'Reel'
            ],
            [
                'id' => '7',
                'empleado' => 'FB Live',
                'rs' => 'Facebook',
                'content' => 'Live'
            ],
            [
                'id' => '8',
                'empleado' => 'IG Live',
                'rs' => 'Instagram',
                'content' => 'Live'
            ]

        ]);
    }

    /**
     * Get all the records from de DB
     *
     * @return Collection
     */
    public function getRecords() : Collection
    {
        return $this->records = Record::all();
    }

    /**
     * Función que se invoca cuando hay un cambio en la vista
     * La vista manda el id del turno y el empleado
     * La función chequea en la DB si existe ese registro
     * si no existe lo crea
     * e invoca la función para recuperar los registros de la DB.
     * Redirecciona a la misma página para evitar repeticiones de empleados en los turnos
     *
     * @param string $toId
     * @param string $empleado
     * @return void
     */
    public function onStatusChanged ( string $toId, string $empleado )
    {
        $record = new Record();
        $record->status = $toId;
        $record->title = $empleado;
        // dd($record);
        $recordAnt = Record::where('status', 'like', $toId)
                            ->where('title', 'like', $empleado)
                            ->first();
        if( !$recordAnt ){
            $record->save();
            session()->flash('message', 'Trabajador: '.strtoupper($empleado).' añadido a turno: '.strtoupper(str_replace ( "_", ' ', $record->status)));
        }
        $this->getRecords();

        return redirect(request()->header('Referer'));
    }

    /**
     * Función para remover registros de la DB
     * La vista llama a la función pasandole el turno y el empleado a remove
     * Comprueba que existan
     * y si existe lo remueve
     * Redirecciona a la misma página para evitar repeticiones de empleados en los turnos
     *
     * @param string $turno
     * @param string $empleado
     * @return void
     */
    public function removeFromDB( string $turno, string $empleado ){

        $record = Record::where('status', 'like', $turno)
                            ->where('title', 'like', $empleado)
                            ->first();
        if($record){
            $record->delete();
            session()->flash('message', 'Trabajador: '.strtoupper($empleado).' eliminado del turno: '.strtoupper(str_replace ( "_", ' ', $record->status)));
        }


        $this->getRecords();
        $this->mount();

        return redirect(request()->header('Referer'));
    }
    public function render()
    {
        //pasamos a la vista los siguientes parametros:
        $empleados = $this->empleados();

        $statuses = $this->statuses();
        $turnos = $this->turnos();
        $records = $this->getRecords();

        $statuses = $statuses
            ->map(function ($status) use ($turnos) {
                $status['group'] = $this->id;
                $status['statusTurnoId'] = "{$this->id}-{$status['id']}";
                // $status['turnos'] = $turnos
                //     ->filter(function ($turno) use ($status) {
                //         return $this->isTurnoInStatus($turno, $status);
                //     });

                return $status;
            });

            return view('livewire.calendar', [
                'records' => $records,
                'statuses' => $statuses,
                'empleados' => $empleados,
                'turnos' => $turnos
            ]);
    }
}
