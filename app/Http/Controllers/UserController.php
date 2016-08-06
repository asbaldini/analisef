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

    public function __construct(User $user)
    {
        if(!Auth::guest())
            $this->loggedUser = Auth::user();

        $this->userModel = $user;
    }

    public function index()
    {
        echo 'index usuário';
    }

    public function create()
    {
        $is_admin = false;
        if(!is_null($this->loggedUser) && $this->loggedUser->role != 'enginner')
        {
            $is_admin = true;
        }

        $roles = array(
            0 => 'Selecione',
            'engineer' => 'Engenheiro',
            'admin' => 'Admin',
        );

        return view('user.create', compact('is_admin', 'roles'));
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
}
