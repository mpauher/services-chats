<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chat') }}
        </h2>
    </x-slot>

    <div class="py-12">

        @if (session('status'))
            <div class="mb-4 rounded-lg bg-success-100 py-5 px-6 text-base text-success-700 alert alert-success"
                role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach ($messages as $message)
                    <div class="chat-message">
                        <div class="flex items-end justify-end py-2">
                            <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-1 items-end">
                                <div><span
                                        class="px-4 py-2 rounded-lg inline-block rounded-br-none bg-blue-600 text-white ">{{ $message->text }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                    <div>
                        <x-input-label for="title" :value="__('Message')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required
                            autofocus autocomplete="title" />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>


                </div>
            </div>
        </div>

    </div>
</x-app-layout>
