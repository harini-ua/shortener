@extends('layouts.main')

@section('content')
    <div class="px-6 h-full text-gray-800">
        <div class="flex xl:justify-center lg:justify-between justify-center items-center flex-wrap h-full g-6">
            <div class="xl:ml-20 xl:w-5/12 lg:w-5/12 md:w-8/12 mb-12 md:mb-0">
                <h1 class="text-5xl font-bold leading-normal mt-0">404</h1>
                <p class="text-gray-500">{{ __('Oops! Something is wrong.') }}</p>
                <p class="text-gray-500">&lt;&nbsp;{{ __('Go') }}&nbsp;<a href="{{ route('home') }}" class="underline">{{ __('Home') }}</a></p>
            </div>
        </div>
    </div>
@endsection
