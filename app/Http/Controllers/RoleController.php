<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionStoreRequest;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:Super.Admin|role-listar|role-editar|role-criar|role-deletar']);
    }

    public function index(Request $request)
    {
        $field = 'name';
        $order = 'ASC';

        if($request->input('order') == 'nameD'){
            $field = 'name';
            $order = 'DESC';
        }

        return Inertia::render('Roles/Index', [
            'filters' => $request->all('search', 'order'),
            'roles' => Role::orderByName()
                ->orderBy($field, $order)
                ->filter($request->only('search', 'order'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($role) => [
                        'id' => $role->id,
                        'name' => $role->name,
                        'permissions_checked' => $role->permissions()->get()
                            ->transform(function ($permission_checked) {
                                return [
                                    'id' => $permission_checked->id,
                                    'name' => $permission_checked->name,
                                ];
                            }),
                ]),
                'permissions' => Permission::get()
                ->transform(function ($permission) {
                    return [
                        'id' => $permission->id,
                        'name' => $permission->name,
                    ];
                }),
        ]);
    }

    public function store(RoleStoreRequest $request)
    {
        $data = $request->validated();

        $roleStore = Role::create($data);


        if (isset($data['permissions'])) {
            foreach ($data['permissions'] as $permission) {

                $p = Permission::where('id', $permission['id'])->firstOrFail();
                $roleStore->givePermissionTo($p);
            }
        }

        if($roleStore){
            $request->session()->flash('toast.message', 'Grupo de permissões cadastrado com sucesso!');
            $request->session()->flash('toast.style', 'success');
        }else{
            $request->session()->flash('toast.message', 'Ops! Erro ao cadastrar grupo de permissões!');
            $request->session()->flash('toast.style', 'danger');
        }

        return back(303);
    }


    public function update(RoleUpdateRequest $request, Role $role)
    {
        $data = $request->validated();

        $roleUpdate = $role->update($data);

        $p_all = Permission::all();

        foreach ($p_all as $p) {
            $role->revokePermissionTo($p); //Remove all permissions associated with role
        }

        if (isset($data['permissions'])) {
            foreach ($data['permissions'] as $permission) {
                $p = Permission::where('id', $permission['id'])->firstOrFail(); //Get corresponding form //permission in db
                $role->givePermissionTo($p);  //Assign permission to role
            }
        }


        if($roleUpdate){
            $request->session()->flash('toast.message', 'Grupo de permissões atualizado com sucesso!');
            $request->session()->flash('toast.style', 'success');
        }else{
            $request->session()->flash('toast.message', 'Ops! Erro ao atualizar grupo de permissões!');
            $request->session()->flash('toast.style', 'danger');
        }

        return back(303);
    }

    public function destroy(Request $request, Role $role)
    {
        $roleDestroy = $role->delete();

        if($roleDestroy){
            $request->session()->flash('toast.message', 'Grupo de permissões excluído com sucesso!');
            $request->session()->flash('toast.style', 'success');
        }else{
            $request->session()->flash('toast.message', 'Ops! Erro ao excluir grupo de permissões!');
            $request->session()->flash('toast.style', 'danger');
        }

        return Redirect::route('roles');
    }
}
