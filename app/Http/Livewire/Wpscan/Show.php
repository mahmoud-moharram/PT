<?php

namespace App\Http\Livewire\Wpscan;

use App\Models\Wpscan;
use Livewire\Component;

class Show extends Component
{
    public $_id;

    public function mount($id){
        $this->_id = $id;
    }

    public function render()
    {
        $data = Wpscan::with('settings')->findOrfail($this->_id);
        $json = ['result' => []];
        if($data->result != 'null'){
            $json = json_decode($data->result,true);
        }
        return view('livewire.wpscan.show',[
            'data' => $data,
            'json' => $json
        ]);
    }
}
