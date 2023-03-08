<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('My Chats') }}
      </h2>
  </x-slot>

  <div class="py-12">

      @if (session('status'))
          <div class="mb-4 rounded-lg bg-success-100 py-5 px-6 text-base text-success-700 alert alert-success" role="alert">
              {{ session('status') }}
          </div>
      @endif

      <div class="max-w-7xl mx-auto mb-4 sm:px-6 lg:px-8">
          <a href=#>
              <x-primary-button>
                  {{ __('New Chat') }}
              </x-primary-button>
          </a>
      </div>

      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900 dark:text-gray-100">

                  @foreach ($chats as $chat)
                      <div class="my-3 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                          style="margin-bottom: 10px;">
                          <a href=#>
                              <img class="rounded-t-lg " src="no-img.jpg" alt="" />
                          </a>
                          <div class="p-5 ">
                              <a href={{route('chat.show',['service_id' => $chat->service_id, 'id' => $chat->chat_id])}}>
                                  <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                      {{ $chat->service_title }}<h5>
                              </a>
                              <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $chat->guest_user_name }}
                              </p>
                          </div>
                      </div>
                  @endforeach
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
