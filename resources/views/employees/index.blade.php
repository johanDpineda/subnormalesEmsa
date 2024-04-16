@extends('layouts.app')
@section('title',__('Employees'))

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @livewire('employees.create')
        @livewire('employees.show')
    </div>
@endsection
