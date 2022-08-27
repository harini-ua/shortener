@extends('layouts.main')

@section('content')
    <div class="px-6 h-full text-gray-800">
        <div class="flex xl:justify-center lg:justify-between justify-center items-center flex-wrap h-full g-6">
            <div class="xl:ml-20 xl:w-5/12 lg:w-5/12 md:w-8/12 mb-12 md:mb-0">
                <form id="shorten" method="POST" action="{{ route('shorten') }}">
                    @csrf
                    <div class="flex flex-row my-4">
                        <p class="text-l">{{ __('Paste the URL to be shortened') }}</p>
                    </div>
                    <div class="mb-4">
                        <input
                            type="text"
                            class="form-control block w-full px-4 py-2 text-l border"
                            id="url"
                            name="url"
                            placeholder="{{ __('Enter the link here') }}"
                            value="{{ old('url') }}"
                        />
                        @error('url')
                        <small class="text-red-600" role="alert">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="form-group mb-6">
                            <label for="limit" class="form-label inline-block mb-2 text-gray-700">{{ __('Click Limit') }}</label>
                            <input type="number"
                                   class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border"
                                   id="limit" name="limit"
                                   min="0" value="{{ old('limit') ?? 0 }}"
                                   placeholder="{{ __('Click Limit') }}"
                            >
                            <small class="block mt-1 text-xs text-gray-600" role="alert">{{ __('* If left 0 then unlimited clicks') }}</small>
                        </div>
                        <div class="form-group mb-6">
                            <label for="expiry" class="form-label inline-block mb-2 text-gray-700">{{ __('Expiry Hours') }}</label>
                            <input type="number"
                                   class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border"
                                   id="expiry" name="expiry"
                                   min="1" max="24" value="{{ old('expiry') ?? 24 }}"
                                   placeholder="{{ __('Expiry in hours') }}"
                            >
                        </div>
                    </div>

                    <div @isset($url)) class="bg-green-100 py-3 px-6 mb-3 text-base text-green-700 inline-flex items-center w-full" role="alert">
                        {{  __('Your shortened URL:') }}&nbsp;<a class="text-l font-semibold " href="{{ $url->short_url }}" target="_blank">{{ $url->short_url }}</a>
                    </div @endisset>

                    <div @if(session()->get('error')) class="bg-yellow-100 py-3 px-6 mb-3 text-base text-yellow-700 inline-flex items-center w-full" role="alert">
                        {{ session()->get('error') }}
                        <button type="button" class="btn-close box-content w-4 h-4 p-1 ml-auto text-yellow-900 border-none rounded-none opacity-50" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div @endif>

                    <div class="lg:text-right">
                        <button type="submit" class="px-7 py-3 bg-blue-600 text-white">
                            {{ __('Shorten URL') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
