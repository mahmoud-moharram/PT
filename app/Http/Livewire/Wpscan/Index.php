<?php

namespace App\Http\Livewire\Wpscan;

use App\Models\PtSetting;
use App\Models\Wpscan;
use Livewire\Component;

class Index extends Component
{

    public $data, $pt_settings_id, $_id;
    public $updateMode = false;

    public function render()
    {
        if(auth()->user()->type == 1){
            $this->data = Wpscan::with('settings')->orderBy('id','desc')->get();

            $domains = PtSetting::where('status',1)->orderBy('id','desc')->get();
        }else{
            $this->data = Wpscan::with('settings')->where('user_id',auth()->id())->orderBy('id','desc')->get();

            $domains = PtSetting::where('user_id',auth()->id())->where('status',1)->orderBy('id','desc')->get();
        }

        return view('livewire.wpscan.index',[
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
        $obj = Wpscan::create(array_merge($validated,['user_id'=>auth()->id()]));
        session()->flash('message', 'تمت عملية الاضافة بنجاح');

        $this->resetInputFields();
        $url = PtSetting::findOrfail($obj->pt_settings_id);
        (new \App\Jobs\NmapCurl($url->domain,$obj->id,'wpscan'))->dispatch($url->domain,$obj->id,'wpscan');
        $this->dispatchBrowserEvent('close-modal');

    }


    public function delete($id)
    {
        if($id){
            Wpscan::where('id',$id)->delete();
            session()->flash('message', 'تم الحدف بنجاح');
        }
    }
}
