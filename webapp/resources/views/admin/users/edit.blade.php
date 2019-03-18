@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar usuario existente</div>

                <div class="card-body">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif

                    <form method="POST" action="{{ route('users.update', [ 'user_id' => $user->id ] ) }}">
                        @method('PATCH')
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-6">
                                <input type="text" id="name" name="name"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       value="{{ old('name', $user->name) }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Correo</label>

                            <div class="col-md-6">
                                <input id="email" type="email" name="email"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       value="{{ old('email', $user->email) }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Nueva contraseña</label>

                            <div class="col-md-6">
                                <input type="password" id="password" name="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       >

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm"
                                   class="col-md-4 col-form-label text-md-right">Repetir contraseña</label>

                            <div class="col-md-6">
                                <input type="password" id="password-confirm" name="password_confirmation"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role"
                                   class="col-md-4 col-form-label text-md-right">Role</label>

                            <div class="col-md-6">
                                <select id="role" name="role" class="form-control" required>
                                    <option value="{{ \App\Interfaces\IUser::ROLE_USER }}"
                                        @if ($user->role == \App\Interfaces\IUser::ROLE_USER)
                                            selected="selected"
                                        @endif>Usuario</option>
                                    <option value="{{ \App\Interfaces\IUser::ROLE_ADMIN }}"
                                        @if ($user->role == \App\Interfaces\IUser::ROLE_ADMIN)
                                            selected="selected"
                                        @endif>Admin</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Actualizar usuario
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
