@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span class="font-weight-bold text-capitalize" style="font-variant:small-caps">
                            {{ __($from->format("M")) }}
                            {{ $from->format("Y") }}
                        </span>
                    </div>

                    <div class="card-body">
                        <table class="table table-sm">
                            <thead class="thead-dark">
                            <tr>
                                <th class="text-center">{{ __('Día') }}</th>
                                @foreach($types as $type)
                                <th class="text-center">{{ __($type) }}</th>
                                @endforeach
                                <th class="text-center">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($monthlyData as $data)
                                <tr @if ($data['isWeekend'])class="weekend" style="background-color:#FB0"@endif>
                                    <td class="badge-dark text-center">{{ $data['date']->format('d') }}</td>
                                    @foreach($types as $type)
                                    <td class="text-center">
                                        @if (array_key_exists($type, $data['types']))
                                            @duration($data['types'][$type]['duration'])
                                        @else
                                            --
                                        @endif
                                    </td>
                                    @endforeach
                                    <td class="text-center font-weight-bold">
                                        @duration($data['duration'])
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
