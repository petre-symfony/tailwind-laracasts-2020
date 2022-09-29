<div>
    <div class="relative">
        <input type="text"
            wire:model.debounce.300ms="search"
            class="
                bg-gray-800 text-sm rounded-full px-3 py-1
                focus:outline-none focus:ring w-64 pl-8
            "
            placeholder="Search..."
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

        <div class="absolute z-50 bg-gray-800 text-xs rounded w-64 mt-2">
            <ul>
                <li class="border-b border-gray-700">
                    <a href="" class="block hover:bg-gray-700 flex items-csnter transition ease-in-out duration-150 px-3 py-3">
                        <img class="w-10" src="https://images.igdb.com/igdb/image/upload/t_cover_small/co4tgy.jpg" alt="cover">
                        <span class="ml-4">Horgihugh and Friends</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
