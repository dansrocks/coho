@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span class="font-weight-bold text-capitalize" style="font-variant:small-caps">Gestión de usuarios</span>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(session()->get('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div><br />
                        @endif

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        @endif

                        <table class="table table-sm table-bordered table-striped table-hover ">
                            <thead class="thead-dark">
                            <tr>
                                <th>Id</th>
                                <th>Role</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th colspan="2">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->role}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td class="text-center">
                                        <a href="{{ route('users.edit',$user->id)}}" class="btn btn-sm btn-primary">Modificar</a>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('users.destroy', $user->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit">Borrar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <hr />
                        <div class="text-right">
                            <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">Crear nuevo usuario</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
