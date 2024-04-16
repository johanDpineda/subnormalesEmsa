@extends('layouts.app')
@section('title',__('macrometer code'))

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y ">
        @livewire('control-terrenos.create')
        @livewire('control-terrenos.show')

    </div>
@endsection
