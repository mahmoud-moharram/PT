<?php

namespace App\Http\Livewire\Subdomain;

use App\Models\Subdomain;
use Livewire\Component;

class Show extends Component
{
    public $_id;

    public function mount($id){
        $this->_id = $id;
    }

    public function render()
    {
        $data = Subdomain::with('settings')->findOrfail($this->_id);
        $json = json_decode($data->result,true);
        if($data->status == 2){
            $json = json_decode(file_get_contents(public_path($data->result)),true);
        }
        return view('livewire.subdomain.show',[
            'data' => $data,
            'json' => $json
        ]);
    }


}
