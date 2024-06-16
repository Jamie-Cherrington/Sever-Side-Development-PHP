<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            {{ __('Vacancies') }}

        </h2>

    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 px-4 py-2 bg-green-100 border border-green-200 text-green-700 rounded-md">
                {{ session('success') }}
            </div>
            @endif

            @if(request()->routeIs('vacancies.index'))
                <a href="{{ route('vacancies.create') }}" class="btn-link btn-lg mb-2">+Create Vacancy</a>
            @endif

            @forelse ($vacancies as $vacancy)

            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg mt-6">

                <h2 class="font-bold text-2xl">

                <a href="{{ route('vacancies.show', $vacancy) }}">{{ $vacancy->title }}</a>
            
                   

                </h2>

                <p class="mt-2"> 


                    
                    {{ Str::limit($vacancy->body, 50) }}

                </p>

               
                <span class="block mt-4 text-sm opacity-70">{{ $vacancy->updated_at->diffForHumans() }}</span>

            </div>

        @empty

            <p>You have no Vacancies yet.</p>

        @endforelse

        {{ $vacancies->links() }}

        </div>

    </div>

</x-app-layout>