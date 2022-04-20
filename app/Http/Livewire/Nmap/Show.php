<?php

namespace App\Http\Livewire\Nmap;

use App\Models\Nmap;
use Livewire\Component;

class Show extends Component
{
    public $_id;

    public function mount($id){
        $this->_id = $id;
    }

    public function render()
    {
        $data = Nmap::with('settings')->findOrfail($this->_id);
        return view('livewire.nmap.show',[
            'data' => $data,
            'json' => json_decode($data->result,true)
        ]);
    }
}
