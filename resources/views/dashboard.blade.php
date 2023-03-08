<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">

        @if (session('status'))
            <div class="mb-4 rounded-lg bg-success-100 py-5 px-6 text-base text-success-700 alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="max-w-7xl mx-auto mb-4 sm:px-6 lg:px-8">
            <a href={{ route('service.new') }}>
                <x-primary-button>
                    {{ __('New Service') }}
                </x-primary-button>
            </a>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @foreach ($services as $service)
                        <div class="my-3 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                            style="margin-bottom: 10px;">
                            <a href=#>
                                <img class="rounded-t-lg " src="{{ asset($service->image) }}" alt="" style="height:300px"/>
                            </a>
                            <div class="p-5 ">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        {{ $service->title }}<h5>
                                </a>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $service->description }}
                                </p>

                                <a href={{ route('chat.show', ['service_id'=> $service->id, 'id' => $service->chat_id]) }}
                                    class="@if($service->type_user === "owner") hidden @endif inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Start Chat
                                    <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
