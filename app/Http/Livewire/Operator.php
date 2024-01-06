<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Operator extends Component
{
    public $user, $name, $email, $password, $password_confirmation;

    public function render()
    {
        $this->user = User::all();
        return view('livewire.operator.index');
    }

    public function resetInputFields()
    {
    	$this->name = '';
    	$this->email = '';
    	$this->password = '';
    }

    public function create()
    {
        $validation = $this->validate([
    		'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'same:password_confirmation'],
    	]);
        try
            {
                $data = array(
                    'name'=>$this->name,
                    'email'=>$this->email,
                    'password'=>Hash::make($this->password)
                );
                User::create($data);
            }
            catch(Exception $exception)
            {
                session()->flash('message','db error'.$exception->getCode());
            }
            session()->flash('message', 'Data telah ditambahkan.');
            $this->resetInputFields();
            $this->emit('operatorStore');
    }

   /*  public function edit($id)
    {
        $data = User::findOrFail($id);
        $this->data_id = $id;
        $this->name = $data->name;
        $this->email = $data->email;
        $this->password = '';
    }

    public function update($id)
    {
        $validate = $this->validate([
    		'name' => 'required',
        ]);
        if (!empty($this->password))
        {
            $user = User::find($this->data_id);
            $d = array(
                'name'=>$this->name,
                'email'=>$this->email,
                'password'=>Hash::make($this->password)
            );
            $user->update($d);
        }else{
            $user = User::find($this->data_id);
            $user->update([
                'name'=>$this->name,
                'email'=>$this->email
            ]);
        }
        session()->flash('message', 'Data telah diupdate.');
        $this->resetInputFields();
        $this->emit('operatorStore');
    } */

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'Data telah dihapus.');
    }
}
