<?php

namespace App\Http\Livewire\Subdomain;

use App\Models\Subdomain;
use App\Models\PtSetting;
use App\Traits\PtTrait;
use Livewire\Component;

class Index extends Component
{
    use PtTrait;
    public $data, $pt_settings_id, $_id;
    public $updateMode = false;

    public function render()
    {
        if(auth()->user()->type == 1){
            $this->data = Subdomain::with('settings')->orderBy('id','desc')->get();
            $domains = PtSetting::where('status',1)->orderBy('id','desc')->get();
        }else{
            $this->data = Subdomain::with('settings')->where('user_id',auth()->id())->orderBy('id','desc')->get();
            $domains = PtSetting::where('user_id',auth()->id())->where('status',1)->orderBy('id','desc')->get();
        }

        return view('livewire.subdomain.index',[
            'domains' => $domains
        ]);
    }

    private function resetInputFields(){
        $this->pt_settings_id = '';
    }

    public function store($type)
    {

        if(!in_array($type,['amass','bufferover_run','hackertarget','cert.sh','fastsubs'])){
            return 'error';
        }
        $validated = $this->validate([
            'pt_settings_id' => 'required',
        ],[
            'pt_settings_id.required' => 'يجب اختيار اسم النطاق'
        ]);
        $obj = Subdomain::create(array_merge($validated,['type' => $type,'user_id'=>auth()->id()]));
        session()->flash('message', 'تمت عملية الاضافة بنجاح');

        $this->resetInputFields();
        $url = PtSetting::findOrfail($obj->pt_settings_id);
        //dd($this->subdomains($url->domain,$obj->id,$type));
        (new \App\Jobs\NmapCurl($url->domain,$obj->id,'subdomains',$type))->dispatch($url->domain,$obj->id,'subdomains',$type);
        $this->dispatchBrowserEvent('close-modal');

    }


    public function delete($id)
    {
        if($id){
            Subdomain::where('id',$id)->delete();
            session()->flash('message', 'تم الحدف بنجاح');
        }
    }

}
