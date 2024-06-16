<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trashed') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @forelse ($vacancies as $vacancy)
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg mt-6">
                <h2 class="font-bold text-2xl">
                    <a href="{{ route('trashed.show', $vacancy) }}">{{ $vacancy->title }}</a>
                </h2>
                <p class="mt-2">
                    {{ Str::limit($vacancy->body, 50) }}
                </p>
                <span class="block mt-4 text-sm opacity-70">{{ $vacancy->updated_at->diffForHumans() }}</span>
            </div>
            @empty
                <p>You have no Vacancies in the trash.</p>
            @endforelse

            {{ $vacancies->links() }}
        </div>

    </div>

</x-app-layout>