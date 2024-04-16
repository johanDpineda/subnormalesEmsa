<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Image;

class Create extends Component
{
    use WithFileUploads;

    public $image;
    public $name;
    public $email;
    public $password;
    public $role;
    public $activo = true; // Nuevo campo para activar/desactivar usuarios

    protected $listeners = [
        'usersCreateChange'
    ];

    protected function rules(){
        return [
            'image'=>'image|max:2048|nullable',
            'name'=>'required',
            'email'=>'required|unique:users|email',
            'password'=>'required|min:8',
            'role'=>'required'
        ];
    }

    protected $messages = [
        'image.max'=>'Your image exceeds 2MB of capacity',
        'name.required'=>'Name field is required',
        'email.required'=>'Email field is required',
        'email.unique'=>'Email already exists',
        'password.required'=>'Password field is required',
        'password.min'=>'Password field requires minimum 8 characters',
        'role.required'=>'Role field is required'
    ];

    public function hydrate(){
        $this->emit('usersCreateHydrate');
    }

    public function usersCreateChange($value, $key){
        $this->$key = $value;
    }

    public function closeAndClean(){
        $this->reset([
            'image',
            'name',
            'email',
            'password',
            'role',
            'activo' // También reseteamos el campo activo
        ]);
        $this->resetValidation([
            'image',
            'name',
            'email',
            'password',
            'role',
            'activo' // También reseteamos el campo activo
        ]);
    }

    public function save(){
        $this->validate();

        $file_name = null;
        if ($this->image){
            $file_name = Str::slug($this->name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->image->getClientOriginalExtension();
            Image::make($this->image)->resize(100, 100)->save(public_path('uploads/users/' . $file_name, 50));
        }

        $user = new User();
        $user->image = $file_name;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = bcrypt($this->password);
        $user->activo = $this->activo; // Asignamos el valor del campo activo
        $user->save();
        $user->roles()->sync($this->role);

        $this->emitTo('users.show','render');
        $this->emit('alert',__('Registered User!'),'#create');
        $this->emit('usersShowRender');
        $this->closeAndClean();

        return redirect()->route('users.index');
    }

    public function render()
    {
        $roles = Role::whereIn('name', ['Admin', 'Centro de Inteligencia','Grupo Social','Control de energia'])->get();
        return view('livewire.users.create', compact('roles'));
    }
}
