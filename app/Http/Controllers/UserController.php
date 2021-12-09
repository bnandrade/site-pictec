<?php

namespace App\Http\Controllers;


//use Illuminate\Support\Facades\Request;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:Super.Admin|usuario-listar|usuario-editar']);
    }

    public function index(Request $request)
    {
        $field = 'name';
        $order = 'ASC';

        if($request->input('order') == 'nameD'){
            $field = 'name';
            $order = 'DESC';
        }elseif($request->input('order') == 'emailC'){
            $field = 'email';
            $order = 'ASC';
        }elseif($request->input('order') == 'emailD'){
            $field = 'email';
            $order = 'DESC';
        }

        return Inertia::render('Users/Index', [
            'filters' => $request->all('search', 'order'),
            'users' => Auth::user()
                ->orderBy($field, $order)
                ->filter($request->only('search', 'order'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($user) => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'roles_user' => $user->roles()->where('name', '<>', 'Super.Admin')->get()->pluck('id'),

                        'permissions_user' => $user->getAllPermissions()->pluck('id'),

                 ]),
                'roles' => Role::with('permissions')
                            ->where('name', '<>', 'Super.Admin')
                            ->get()
                            ->transform(function ($role) {
                                return [
                                    'id' => $role->id,
                                    'name' => $role->name,
                                    'permissions' => $role->permissions
                                ];
                            }),
                'permissions' => Permission::get()
                    ->transform(function ($permission) {
                        return [
                            'id' => $permission->id,
                            'name' => $permission->name,
                        ];
                    }),
        ]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        if(Auth::user()->can('usuario-editar')) {
            $data = $request->validated();

            $roles = $data['role'];
            $permissions = $data['permission'];

            $verificaAdmin = $user->hasRole('Super.Admin');

            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles

            $verificaAdmin ? $user->assignRole('Super.Admin') : "";

            $user->syncPermissions($permissions);

            $userUpdate = $user->update($data);

            if($userUpdate){
                $request->session()->flash('toast.message', 'Usuário atualizado com sucesso!');
                $request->session()->flash('toast.style', 'success');
            }else{
                $request->session()->flash('toast.message', 'Ops! Erro ao atualizar usuário!');
                $request->session()->flash('toast.style', 'danger');
            }

            return back(303);
        }else{
            abort('403');
        }
    }


}
