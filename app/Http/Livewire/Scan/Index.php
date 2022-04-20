<?php

namespace App\Http\Livewire\Scan;

use App\Models\PtSetting;
use App\Models\Scan;
use Livewire\Component;

class Index extends Component
{
    public $data, $pt_settings_id, $_id;
    public $updateMode = false;

    public function render()
    {
        $this->data = Scan::with('settings')->get();
        $domains = PtSetting::all();
        return view('livewire.scan.index',[
            'domains' => $domains
        ]);
    }

    private function resetInputFields(){
        $this->pt_settings_id = '';
    }

    public function store()
    {
        $validated = $this->validate([
            'pt_settings_id' => 'required',
        ],[
            'pt_settings_id.required' => 'يجب اختيار اسم النطاق'
        ]);
        Scan::create($validated);
        session()->flash('message', 'تمت عملية الاضافة بنجاح');

        $this->resetInputFields();
        /*$this->emit('ScanEmit');*/
        $this->dispatchBrowserEvent('close-modal');

    }

    public function show($id)
    {
        dd('show '.$id);
    }

    public function delete($id)
    {
        if($id){
            Scan::where('id',$id)->delete();
            session()->flash('message', 'تم الحدف بنجاح');
        }
    }

}
