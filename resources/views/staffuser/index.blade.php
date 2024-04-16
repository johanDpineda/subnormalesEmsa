@extends('layouts.app')
@section('title',__('Staff User'))

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @livewire('staffuser.create')
        @livewire('staffuser.show')
    </div>
@endsection
