@extends('frontend.layouts.app')
@section('title',__('Emsa'))
@section('content')
    <div>
        <div>
            <div class="content h-100">
                    <livewire:frontend.indexteams :leagueSlugindex />
            </div>
        </div>
    </div>

@endsection
