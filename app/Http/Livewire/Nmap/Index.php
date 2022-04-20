<?php

namespace App\Http\Livewire\Nmap;

use App\Events\NmapCurl;
use App\Models\Nmap;
use App\Models\PtSetting;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Index extends Component
{
    public $data, $pt_settings_id, $_id;
    public $updateMode = false;

    public function render()
    {
        if(auth()->user()->type == 1){
            $this->data = Nmap::with('settings')->orderBy('id','desc')->get();

            $domains = PtSetting::where('status',1)->orderBy('id','desc')->get();
        }else{
            $this->data = Nmap::with('settings')->where('user_id',auth()->id())->orderBy('id','desc')->get();

            $domains = PtSetting::where('user_id',auth()->id())->where('status',1)->orderBy('id','desc')->get();
        }

        return view('livewire.nmap.index',[
            'domains' => $domains
        ]);
    }

    private function resetInputFields(){
        $this->pt_settings_id = '';
    }

    public function store($type)
    {

        if(!in_array($type,['Sv_scan','os_scan','top_ports','vulners','Sc_scan','vuln','port_80_433','nmap_http','ftp_anon','ftp_vulns'])){
            return 'error';
        }

        $validated = $this->validate([
            'pt_settings_id' => 'required',
        ],[
            'pt_settings_id.required' => 'يجب اختيار اسم النطاق'
        ]);
        $obj = Nmap::create(array_merge($validated,['type' => $type,'user_id'=>auth()->id()]));
        session()->flash('message', 'تمت عملية الاضافة بنجاح');

        $this->resetInputFields();
        $url = PtSetting::findOrfail($obj->pt_settings_id);
        //dd($this->subdomains($url->domain,$obj->id,$type));
        (new \App\Jobs\NmapCurl($url->domain,$obj->id,'nmap',$type))->dispatch($url->domain,$obj->id,'nmap',$type);
        $this->dispatchBrowserEvent('close-modal');

    }


    public function delete($id)
    {
        if($id){
            Nmap::where('id',$id)->delete();
            session()->flash('message', 'تم الحدف بنجاح');
        }
    }



}
