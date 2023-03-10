<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('My Services') }}
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
              <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-wrap ">

                  @foreach ($services as $service)
                      <div class="my-3 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 w-full md:w-1/3"
                          style="margin-bottom: 10px;">
                          <a href="{{ route('service.show', $service->id)}}">
                              <img class="rounded-t-lg " style="height:300px; width:100%; object-fit:cover;" src={{ asset($service->image) }} alt="" />
                          </a>
                          <div class="p-5 ">
                              <a href="#">
                                  <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                      {{ $service->title }}<h5>
                              </a>
                              <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $service->description }}
                              </p>
                          </div>
                      </div>
                  @endforeach
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
