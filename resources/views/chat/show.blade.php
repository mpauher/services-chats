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

                    <div class="mt-3">

                        <form action="{{ route('chat.send',[$service_id, $chat_id])}}" method="POST">
                            @csrf
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Message:</label>
                            <textarea rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..." name="text" id="message" required></textarea>
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"type="submit">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
