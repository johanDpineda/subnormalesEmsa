@extends('layouts.app')
@section('title',__('SubNormales'))

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y ">
        @livewire('crear-subnormal.create')
        @livewire('crear-subnormal.show')

    </div>
@endsection
