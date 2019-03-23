@extends('layouts.app')

@section('content')
<div class="container" xmlns="http://www.w3.org/1999/html">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registro de horarios</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif

                    <div class="row p-2">
                        <div class="col-3">
                            <!-- aquí irá la imagen -->
                        </div>
                        <div class="col-2"></div>
                        <div class="col text-center">
                            @if (! $timeClock instanceof \App\Interfaces\ITimeClock)
                                <form action="{{ route('clockin') }}" method="get">
                                    @csrf
                                    <p>No estás fichado.</p>
                                    <hr>
                                    <strong>Fichar:</strong>
                                    <select name="clocktype" class="custom-select">
                                        @foreach($clockTypes as $clocktype)
                                            <option>{{ __($clocktype) }}</option>
                                        @endforeach
                                    </select>
                                    <br />
                                    <br />
                                    <input type="submit" class="btn btn-sm btn-success font-weight-bold" value="CLOCK IN" />
                                </form>
                            @else
                                <form action="{{ route('clockout') }}" method="get">
                                    @csrf
                                    <p>Actualmente estás fichado en:
                                        <input class="form-control text-center font-weight-bold"
                                               value="{{ __($timeClock->getType()) }}"
                                               disabled="disabled">
                                    </p>
                                    <input type="submit" class="btn btn-sm btn-success font-weight-bold" value="CLOCK OUT" />
                                </form>
                            @endif
                        </div>
                        <div class="col-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
