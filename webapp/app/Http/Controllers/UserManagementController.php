<?php

namespace App\Http\Controllers;

use App\Interfaces\IUser;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


/**
 * Class UserManagementController
 *
 * @package App\Http\Controllers
 */
class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content = [
            'users' => User::all()
        ];

        return view('admin.users.view', $content);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->get('name'),
            'role' => IUser::ROLE_USER,
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $message = sprintf("Usuario '%s' creado con éxito", $user->name);

        return redirect(route('users.index'))->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $content = [
                'user' => User::findOrFail($id)
            ];
            $action = view('admin.users.edit', $content);

        } catch (ModelNotFoundException $exception) {
            $action = redirect(route('users.index'))
                ->withErrors('El usuario no existe.');
        }

        return $action;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $action = redirect(route('users.index'));

        try {
            $data = [];

            $roleValidation = sprintf("in:%s", implode(',', [IUser::ROLE_USER, IUser::ROLE_ADMIN]));
            $request->validate([
                'name' => 'required|string|min:3|max:255',
                'email' => 'present|string|email|max:255',
                'password' => 'present|confirmed',
                'role' => 'required|string|' . $roleValidation,
            ]);

            $data['name'] = $request->get('name');
            $data['role'] = $request->get('role');

            $hasPassword = ! empty($request->get('password'));
            if ($hasPassword) {
                $request->validate([
                    'password' => 'min:8',
                ]);
                $data['password'] = Hash::make($request->get('password'));
            }

            $user = User::find($id);
            if ($user->email != $request->get('email')) {
                $request->validate([
                    'email' => 'unique:users,email',
                ]);
                $data['email'] = $request->get('email');
            }

            $user->update($data);
            $user->save();

            $action->with('success', "Usuario actualizado");

        } catch (ModelNotFoundException $exception) {
            $action->withErrors('Usuario no existe o es inválido');
        }

        return $action;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        $action = redirect(route('users.index'));

        try {
            if (Auth::user()->id != $id) {
                /** @var User $user */
                $user = User::findOrFail($id);
                $user->delete();
                $action->with('success', "Usuario eliminado");

            } else {
                $action->withErrors('No puedes borrarte a ti mismo como usuario');
            }
        } catch (ModelNotFoundException $exception) {
            $action->withErrors("Usuario inexistente");
        }

        return $action;
    }
}
