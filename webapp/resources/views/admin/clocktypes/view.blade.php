@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span class="font-weight-bold text-capitalize" style="font-variant:small-caps">Tipos de registros de tiempo</span>
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
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th colspan="2">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($clockTypes as $clockType)
                                <tr>
                                    <td>{{$clockType->name}}</td>
                                    <td>{{$clockType->description}}</td>
                                    <td class="text-center">
                                        <a href="{{ route('clocktypes.edit',$clockType->id)}}" class="btn btn-sm btn-primary">Modificar</a>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('clocktypes.destroy', $clockType->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit">Borrar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        No se ha creado ningún registro todavía.
                                        <a href="{{ route('clocktypes.create') }}">Crear registro</a>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <hr />
                        <div class="text-right">
                            <a href="{{ route('clocktypes.create') }}" class="btn btn-sm btn-primary">Crear nuevo registro</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
