<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Response\Success;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * @var $request
     */
    protected $request;

    /**
     * @var $model
     */
    protected $model;

    public function __construct
    (
        Request $request,
        User $model
    )
    {
        $this->request                      = $request;
        $this->model                        = $model;
        $this->request["model"]             = $model;
    }


    /**
     * Display a listing of the resource.
     *
     * @return bool|\Illuminate\Http\RedirectResponse|void
     */
    public function index()
    {
        $users = $this->model::paginate(10);
        return Success::generic($users, messageSuccess(20004, "Usuário"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool|\Illuminate\Http\RedirectResponse|void
     */
    public function store()
    {
        if($this->request->password)
        {
            $this->request['password'] = Hash::make($this->request['password']);
        }
        $action = $this->model->create($this->request->all());
        return Success::generic($action, messageSuccess(20000, "Usuário"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return bool|\Illuminate\Http\RedirectResponse|void
     */
    public function show($id)
    {
        $users = $this->model::find($id);
        return Success::generic($users, messageSuccess(20003, "Usuário"));
    }

    /**
     * @param $id
     * @return bool|\Illuminate\Http\RedirectResponse|void
     */
    public function update($id)
    {
        $model = $this->model::find($id);
        $this->model::scopeUpdatePassword($model, $this->request);
        $model->update($this->request->all());
        return Success::generic($model, messageSuccess(20001, "Usuário"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return bool|\Illuminate\Http\RedirectResponse|void
     */
    public function destroy($id)
    {
        $this->model->destroy($id);
        return Success::generic(null, messageSuccess(20002, "Usuário"));
    }
}
