<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Image;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    use WithFileUploads;
    use WithPagination;

    //Edit
    public $user;
    public $roles;
    public $user_image;
    public $image;
    public $name;
    public $email;
    public $password;
    public $user_password;
    public $role;
    public $user_role;
    public $activo; // Nuevo campo para activar/desactivar usuarios
    protected function rules(){
        return [
            'image'=>'image|max:2048|nullable',
            'name'=>'',
            'email'=>'required|email',
            'password'=>'',
            // 'user.password'=>'min:8',
            // 'user.role'=>''
            'activo' => 'boolean' // Regla de validación para el campo activo // Regla de validación para el campo activo
        ];
    }



    protected $paginationTheme ='bootstrap';

    protected $listeners = [
      'usersShowChange',
      'usersShowRender'=>'render'
    ];

    public $readyToLoad = false;
    public $maintenance = false;
    public $query = '';
    public $cant = '10';

    protected $queryString = [
        'cant'=>['except'=>'10'],
        'query'=>['except'=>'']
    ];

    public function updatingQuery(){
        $this->resetPage();
    }

    public function hydrate(){
        $this->emit('usersShowHydrate');
    }

    public function userShowChange($value, $key){
        $this->$key = $value;
    }

    public function readyToLoad(){
        $this->readyToLoad= true;
    }

    public function mount(User $user){
        $this->user = $user;

        $this->roles = Role::whereIn('name', ['Admin', 'Editor','Centro de Inteligencia'])->get();


    }

    public function toggleActivo($userId)
    {
        $user = User::find($userId);
        $user->activo = !$user->activo;
        $user->save();
    }



    public function render()
    {
        if ($this->readyToLoad){
            $users = $this->chargingData();
        }else{
            $users = [];
        }
        return view('livewire.users.show', compact('users'));
    }

    public function chargingData(){
        return User::where(function($query){
           if ($this->query){
               $query->where('name','like','%'.$this->query.'%');
           }
        })->paginate($this->cant);
    }

    public function edituser(User $user){
        $this->user = $user;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->user_image = $this->user->image;
        $this->user_password = $this->user->password;

    }

    public function updateuser(){
        if ($this->image){
            \Illuminate\Support\Facades\File::delete(public_path('uploads/users/'.$this->user->image));
            $file_name = Str::slug($this->user->name).'-'.Carbon::now()->locale('co')->format('Y-m-d-H-i-s').'.'.$this->image->getClientOriginalExtension();
            Image::make($this->image)->resize(400, 400)->save(public_path('uploads/users/' . $file_name, 50));
        }else{
            $file_name = $this->user_image;
        }

        $this->user->image = $file_name;

        if ($this->name){
            $this->user->name = $this->name;
        }

        if ($this->email){
            $this->user->email = $this->email;
        }

        if ($this->user_password){
            $this->user->password = bcrypt($this->user_password);
        }

        $this->user->save();

        if ($this->role){
            $this->user->roles()->sync($this->role);
        }

        $this->emitTo('users.show','render');
        $this->emit('alert',__('User updated!'),'#edit');
        $this->emit('usersShowRender');
    }
}
