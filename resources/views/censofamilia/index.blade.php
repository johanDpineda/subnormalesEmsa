@extends('layouts.app')
@section('title',__('census'))

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y ">
        @livewire('censo.create')
        @livewire('censo.show')

    </div>
@endsection
