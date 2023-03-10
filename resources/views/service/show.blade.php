<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __($service->title) }}
      </h2>
  </x-slot>

  <div class="py-12">

      @if (session('status'))
          <div class="mb-4 rounded-lg bg-success-100 py-5 px-6 text-base text-success-700 alert alert-success"
              role="alert">
              {{ session('status') }}
          </div>
      @endif

      <div class="w-full mx-auto mb-4 sm:px-6 lg:px-8">
        <a href="#" class=" w-full flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
          <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="/docs/images/blog/image-4.jpg" alt="">
          <div class="flex flex-col justify-between p-4 leading-normal">
              <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $service->title }}</h5>
              <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $service->description }}</p>
          </div>
      </a>
      </div>


  </div>
</x-app-layout>
