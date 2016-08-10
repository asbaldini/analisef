<?php

namespace AnaliseF\Http\Controllers;

use AnaliseF\Http\Requests\UserRequest;
use AnaliseF\User;
use Illuminate\Http\Request;

use AnaliseF\Http\Requests;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userModel;
    private $loggedUser;
    private $is_admin;
    private $roles;

    public function __construct(User $user)
    {
        $this->is_admin = false;

        if(!Auth::guest()){
            $this->loggedUser = Auth::user();

            if($this->loggedUser->role != 'enginner'){
                $this->is_admin = true;
            }
        }

        $this->userModel = $user;

        $this->roles = array(
            0 => 'Selecione',
            'engineer' => 'Engenheiro',
            'admin' => 'Admin',
        );
    }

    public function index()
    {
        $users = $this->userModel->getUsers();

        return view('user.index', compact('users'));
    }

    public function create()
    {
        $is_admin = $this->is_admin;

        $roles = $this->roles;

        $action_title = 'Novo usuário';

        return view('user.create', compact('is_admin', 'roles', 'action_title'));
    }

    public function store(UserRequest $request)
    {
        $input = $request->all();

        // Service layer
        $input['password'] = bcrypt($input['password']);

        if(!$this->userModel->saveUser($input))
        {
            return redirect()->back()->withErrors(array('action.error' => 'Erro ao salvar usuário!'));
        }

        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        $is_admin = $this->is_admin;

        $roles = $this->roles;

        $user = $this->userModel->find($id);

        $action_title = 'Editar usuário #'.$id;

        return view('user.edit', compact('is_admin', 'roles', 'user', 'action_title'));
    }

    public function update(UserRequest $request, $id)
    {
        $input = $request->all();

        // Service layer
        if(!empty($input['password'])) {
            $input['password'] = bcrypt($input['password']);
        }

        if(!$this->userModel->updateUser($input, $id))
        {
            return redirect()->back()->withErrors(array('action.error' => 'Erro ao atualizar usuário!'));
        }

        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        if(!$this->userModel->deleteUser($id))
        {
            return 'ERROR';
        }

        return 'SUCCESS';
    }
}
