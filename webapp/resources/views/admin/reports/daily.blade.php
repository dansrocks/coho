@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="font-weight-bold text-capitalize" style="font-variant:small-caps">{{ __($today->("%M")) }}</span>
                    </div>

                    <div class="card-body">
                        ESSD
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
