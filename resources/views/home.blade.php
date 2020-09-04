@extends('layouts.app')

@section('content')


    <div class="lg:flex lg:justify-between" style="display: flex">
        <div class="w-1/4 bg-blue-100 rounded-lg p-4">
             @include('yourTeam') 
        </div>

            <div class="lg:flex-1 lg:mx-10" style="max-width: 700px">
                @include('publish_poll_panel')

                <div class="border border-gray-300 rounded-lg">
                    @foreach ($polls as $poll)
                        @include('single_poll')    
                    @endforeach
                </div>
            </div>

        <div class="lg:w-1/6 ">
            @include('profile')
        </div>
    </div>
@endsection
