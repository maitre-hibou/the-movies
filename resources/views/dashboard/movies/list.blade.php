<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Movies management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2>Movies list</h2>

                    <table class="border-collapse w-full border border-slate-400 dark:border-slate-500 dark:bg-slate-800 text-sm shadow-sm">
                        <thead>
                            <tr>
                                <th class="border border-slate-600"></th>
                                <th class="border border-slate-600">Title</th>
                                <th class="border border-slate-600">Overview</th>
                                <th class="border border-slate-600"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($movies as $movie)
                                <tr>
                                    <td class="border border-slate-700"><img src="{{ App\Service\External\TheMovieDb\Utils::getImageUrl($movie->poster, 'w500') }}" alt="{{ $movie->title }}"></td>
                                    <td class="border border-slate-700 px-3">{{ $movie->title }}</td>
                                    <td class="border border-slate-700 px-3">{{ $movie->overview }}</td>
                                    <td class="border border-slate-700 px-3">
                                        <x-dropdown align="right" width="48">
                                            <x-slot name="trigger">
                                                <button class="inline-flex items-center px-3 py-2 border  text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                                    <div>Actions</div>

                                                    <div class="ms-1">
                                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                </button>
                                            </x-slot>

                                            <x-slot name="content">
                                                <x-dropdown-link :href="route('dashboard.movies.list')">
                                                    {{ __('Edit') }}
                                                </x-dropdown-link>

                                                <x-dropdown-link :href="route('dashboard.movies.list')">
                                                    {{ __('Delete') }}
                                                </x-dropdown-link>
                                            </x-slot>
                                        </x-dropdown>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <x-dropdown align="right" width="48" class="pt-3">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border  text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>Page</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @for($i = 1; $i <= $totalMoviesPage; ++$i)
                                <x-dropdown-link :href="'?page='.$i">
                                    {{ sprintf('Page %d', $i) }}
                                </x-dropdown-link>
                            @endfor
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
