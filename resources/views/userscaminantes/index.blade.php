@extends('layouts.app')
@section('title',__('Walkers'))

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @livewire('usercaminante.create')
        @livewire('usercaminante.show')

    </div>
@endsection
