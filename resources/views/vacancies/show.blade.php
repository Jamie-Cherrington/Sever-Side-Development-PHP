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

            <div class="flex">

                <p class="text-white opacity-70 sm:px-6">

                    <strong>Created: </strong> {{ $vacancy->created_at->diffForHumans() }}

                </p>

                <p class="text-white opacity-70 ml-8">

                    <strong>Updated: </strong> {{ $vacancy->created_at->diffForHumans() }}

                </p>
                <a href = "{{ route('vacancies.edit', $vacancy) }}" class="btn-link ml-auto">Edit Vacancy</a>
                    <form action="{{ route('vacancies.destroy', $vacancy) }}" method="post">
                        @method('Delete')
                        
                        <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure you wish to move to trash?')">Move to Trash</button>
                    </form>
                

            </div>

            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">

                <h2 class="font-bold text-4xl">

                {{ $vacancy->title }}

                </h2>
                    
                <p class="pt-4 italic">
                    Categories:
                    @forelse ($vacancy->categories as $category)
                        {{$category->topic}} @if (!$loop->last), @endif
                    @empty
                    <span>No categories defined for this vacancy.</span>
                    @endforelse
                    

                </p>
                

                <p class="mt-6 whitespace-pre-wrap">{{ $vacancy->body }}</p>
                

                

            </div>
            {{ $vacancy->comments()->paginate(5)->links()}} 
            
            <livewire:comments :model="$vacancy"/>
        </div>

    </div>

</x-app-layout>
