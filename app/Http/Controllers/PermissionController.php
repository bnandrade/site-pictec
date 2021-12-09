<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionStoreRequest;
use App\Http\Requests\PermissionUpdateRequest;
use App\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:Super.Admin|permissao-listar|permissao-editar|permissao-criar|permissao-deletar']);
    }

    public function index(Request $request)
    {

        $field = 'name';
        $order = 'ASC';

        if($request->input('order') == 'nameD'){
            $field = 'name';
            $order = 'DESC';
        }

        return Inertia::render('Permissions/Index', [
            'filters' => $request->all('search', 'order'),
            'permissions' => Permission::orderByName()
                ->orderBy($field, $order)
                ->filter($request->only('search', 'order'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($permission) => [
                    'id' => $permission->id,
                    'name' => $permission->name,
                    'roles_checked' => $permission->roles()->get()
                            ->transform(function ($role_checked) {
                                return [
                                    'id' => $role_checked->id,
                                    'name' => $role_checked->name,
                                ];
                            }),
                ]),

                'roles' => Role::get()
                    ->transform(function ($role) {
                        return [
                            'id' => $role->id,
                            'name' => $role->name,
                        ];
                    }),
        ]);
    }


    public function store(PermissionStoreRequest $request)
    {
        $data = $request->validated();

        $permissionStore = Permission::create($data);

        $permission = Permission::where('name', '=', $data['name'])->first(); //Match input //permission to db record

        if (isset($data['roles'])) {
            foreach ($data['roles'] as $role) {
                $r = Role::where('id', $role['id'])->firstOrFail(); //Match input role to db record
                $r->givePermissionTo($permission);
            }
        }

        if($permissionStore){
            $request->session()->flash('toast.message', 'Permissão cadastrada com sucesso!');
            $request->session()->flash('toast.style', 'success');
        }else{
            $request->session()->flash('toast.message', 'Ops! Erro ao cadastrar permissão!');
            $request->session()->flash('toast.style', 'danger');
        }

        return back(303);
    }

    public function update(PermissionUpdateRequest $request, Permission $permission)
    {
        $data = $request->validated();

        $permissionUpdate = $permission->update($data);

        $r_all = Role::all();
        foreach ($r_all as $r) {
            $r->revokePermissionTo($permission); //Remove the permission associated with all roles

        }

        if (isset($data['roles'])) {
            foreach ($data['roles'] as $role) {
                $r = Role::where('id', $role['id'])->firstOrFail(); //Match input role to db record
                $r->givePermissionTo($permission);

            }
        }


        if($permissionUpdate){
            $request->session()->flash('toast.message', 'Permissão atualizada com sucesso!');
            $request->session()->flash('toast.style', 'success');
        }else{
            $request->session()->flash('toast.message', 'Ops! Erro ao atualizar permissão!');
            $request->session()->flash('toast.style', 'danger');
        }

        return back(303);
    }

    public function destroy(Request $request, Permission $permission)
    {
        $permissionDestroy = $permission->delete();

        if($permissionDestroy){
            $request->session()->flash('toast.message', 'Permissão excluída com sucesso!');
            $request->session()->flash('toast.style', 'success');
        }else{
            $request->session()->flash('toast.message', 'Ops! Erro ao excluir permissão!');
            $request->session()->flash('toast.style', 'danger');
        }

        return Redirect::route('permissions');
    }
}
