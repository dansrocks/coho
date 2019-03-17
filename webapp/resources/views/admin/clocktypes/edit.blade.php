@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Actualizar el tipo de registro de tiempo '{{ $clockType->name }}'</div>

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
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div><br />
                        @endif

                        <form method="post" action="{{ route('clocktypes.update', $clockType->id) }}">
                            <div class="form-group row">
                                @method('PATCH')
                                @csrf
                                <label for="name" class="col-sm-3 col-form-label text-right">Nombre:</label>
                                <div class="col-sm-4">
                                    <input type="text"
                                           name="clocktype_name"
                                           class="form-control"
                                           maxlength="14"
                                           value="{{ $clockType->name }}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="price" class="col-sm-3 col-form-label text-right">Descripción :</label>
                                <div class="col-sm-9">
                                    <textarea name="clocktype_description"
                                              class="form-control"
                                              maxlength="115"
                                              >{{ $clockType->description }}</textarea>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
