@extends('layouts.app')
@section('title',__('Walkers'))

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y ">
        @livewire('datoscaminante.create')
        @livewire('datoscaminante.show')

    </div>
@endsection
