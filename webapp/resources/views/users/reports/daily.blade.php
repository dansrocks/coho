@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span class="font-weight-bold text-capitalize" style="font-variant:small-caps">
                            {{ __($today->format("D")) }}
                            {{ $today->format("d") }}
                            {{ __($today->format("M")) }}
                            {{ $today->format("Y") }}
                        </span>
                    </div>

                    <div class="card-body">
                        <table class="table table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Fecha</th>
                                    <th>Tipo</th>
                                    <th>Entrada</th>
                                    <th>Salida</th>
                                    <th>Tiempo</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($timeClocks as $timeClock)
                                <tr>
                                    <th>@date($timeClock->getDate())</th>
                                    <th>{{ __($timeClock->getType() ) }}</th>
                                    <th>@time($timeClock->getClockInTime())</th>
                                    <th>@if ($timeClock->onClockOut())
                                            @time($timeClock->getClockOutTime())
                                        @else
                                            --
                                        @endif
                                    </th>
                                    <th>@if ($timeClock->onClockOut())
                                            @duration($timeClock->getDuration())
                                        @else
                                            --
                                        @endif
                                    </th>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="bg-warning">
                                        {{ __('No hay fichajes este día') }}
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
