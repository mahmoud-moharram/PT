<?php

namespace App\Http\Livewire\Settings;

use App\Models\PtSetting;
use Livewire\Component;

class Index extends Component
{
    public $data, $domain, $_id;
    public $updateMode = false;

    public function render()
    {
        if(auth()->user()->type == 1){
            $this->data = PtSetting::with('user')->orderBy('id','desc')->get();
        }else{
            $this->data = PtSetting::where('user_id',auth()->id())->orderBy('id','desc')->get();
        }
        return view('livewire.settings.index');
    }
    private function resetInputFields(){
        $this->domain = '';
    }

    public function store()
    {
        $validated = $this->validate([
            'domain' => 'required',
        ],[
            'domain.required' => 'يجب ادخال اسم النطاق'
        ]);
        PtSetting::create(array_merge($validated,['user_id' => auth()->id()]));
        session()->flash('message', 'تمت عملية الاضافة بنجاح');

        $this->resetInputFields();
        $this->emit('DomainEmit');
        /*$this->dispatchBrowserEvent('close-modal');*/

    }

    public function edit($id)
    {

        $this->updateMode = true;
        $data = PtSetting::where('id',$id)->first();
        $this->_id = $id;
        $this->domain = $data->domain;
    }


    public function update()
    {
       $this->validate([
            'domain' => 'required',
        ],[
            'domain.required' => 'يجب ادخال اسم النطاق'
        ]);

        if ($this->_id) {
            $obj = PtSetting::find($this->_id);
            $obj->update([
                'domain' => $this->domain,
            ]);
            $this->updateMode = false;
            session()->flash('message', 'تم التعديل بنجاح');
            $this->resetInputFields();
            $this->emit('DomainEmit');
        }
    }

    public function delete($id)
    {
        if($id){
            PtSetting::where('id',$id)->delete();
            session()->flash('message', 'تم الحدف بنجاح');
        }
    }

    public function enable($id)
    {
        if($id){
            PtSetting::where('id',$id)->update([
                'status' => 1
            ]);
            session()->flash('message', 'تم التعديل بنجاح');
        }
    }
    public function disable($id)
    {
        if($id){
            PtSetting::where('id',$id)->update([
                'status' => 0
            ]);
            session()->flash('message', 'تم التعديل بنجاح');
        }
    }

}
