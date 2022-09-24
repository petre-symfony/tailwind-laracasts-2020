<div wire:init="loadComingSoon">
    @forelse($comingSoonGames as $game)
        <div class="game flex">
            <a href="#">
                <img src="{{ $game['coverImageUrl'] }}" alt="game cover" class="w-16 hover:opacity-75 transition ease-in-out duration-150">
            </a>
            <div class="ml-4">
                <a href="#" class="hover:text-gray-300">{{ $game['name'] }}</a>
                <div class="text-gray-400 text-sm mt-1">{{ $game['releaseDate'] }}</div>
            </div>
        </div>
    @empty
        @foreach(range(1, 4) as $game)
            <div class="game flex">
                <div class="bg-gray-800 w-16 h-20 flex-none"></div>
                <div class="ml-4">
                    <div class="text-transparent bg-gray-700 rounded leading-tight">Title goes here today</div>
                    <div class="text-transparent bg-gray-700 rounded inline-block text-sm mt-2">Sept 14, 2022</div>
                </div>
            </div>
        @endforeach
    @endforelse
</div>
