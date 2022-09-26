<div wire:init="loadComingSoon">
    @forelse($comingSoonGames as $game)
        <x-game-card-small :game="$game" />
    @empty
        @foreach(range(1, 4) as $game)
            <x-game-card-small-skeleton />
        @endforeach
    @endforelse
</div>
