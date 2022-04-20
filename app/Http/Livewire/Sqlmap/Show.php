<?php

namespace App\Http\Livewire\Sqlmap;

use App\Models\Sqlmap;
use Livewire\Component;

class Show extends Component
{
    public $_id;

    public function mount($id){
        $this->_id = $id;
    }

    public function render()
    {
        $data = Sqlmap::with('settings')->findOrfail($this->_id);
        $json = ['result' => []];
        if($data->result != 'null'){
            $json = json_decode($data->result,true);
        }
        return view('livewire.sqlmap.show',[
            'data' => $data,
            'json' => $json
        ]);
    }
}
