<div>
    <div class="relative" x-data="{ isVisible: true }" @click.away="isVisible = false">
        <input type="text"
            wire:model.debounce.300ms="search"
            class="
                bg-gray-800 text-sm rounded-full px-3 py-1
                focus:outline-none focus:ring w-64 pl-8
            "
            placeholder="Search..."
            @focus="isVisible = true"
            @keydown.escape.window = "isVisible = false"
            @keydown = "isVisible = true"
        >

        <div class="absolute top-0 flex items-center h-full ml-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor"
                class="text-gray-400 w-4"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
        </div>

        <div wire:loading class="spinner top-0 right-0 mr-4 mt-3" style="position: absolute"></div>

        @if(strlen($search) >= 2)
            <div class="absolute z-50 bg-gray-800 text-xs rounded w-64 mt-2" x-show="isVisible">
                @if(count($searchResults) > 0)
                    <ul>
                        @foreach($searchResults as $game)
                        <li class="border-b border-gray-700">
                            <a href="{{ route('games.show', $game['slug']) }}" class="block hover:bg-gray-700 flex items-csnter transition ease-in-out duration-150 px-3 py-3">
                                @if (isset($game['cover']))
                                    <img class="w-10" src="{{ Str::replaceFirst('thumb', 'cover_small', $game['cover']['url']) }}" alt="cover">
                                @else
                                    <img class="w-10" src="https://via.placeholder.com/264x352" alt="">
                                @endif
                                <span class="ml-4">{{ $game['name'] }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <div class="px-3 py-3">No results for "{{ $search }}"</div>
                @endif
            </div>
        @endif
    </div>
</div>
