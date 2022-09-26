<div wire:init="loadMostAnticipated" class="most-anticipated-container space-y-10 mt-8">
    @forelse($mostAnticipatedGames as $game)
        <x-game-card-small :game="$game" />
    @empty
        @foreach(range(1, 4) as $game)
        <div class="game flex">
            <div class="bg-gray-800 w-16 h-20 flex-none"></div>
            <div class="ml-4">
                <div class="text-transparent bg-gray-700 rounded leading-tight">Title goes here today</div>
                <div class="text-transparent bg-gray-700 rounded inline-block text-sm mt-4">Sept 14, 2022</div>
            </div>
        </div>
        @endforeach
    @endforelse
</div>
