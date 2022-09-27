<div>
    <div class="game mt-8">
        <div class="relative inline-block">
            <a href="{{ route('games.show', $game['slug']) }}">
                <img src="{{ $game['coverImageUrl'] }}" alt="game cover" class="hover:opacity-75 transition ease-in-out duration-150">
            </a>
            @if(isset($game['rating']))
                <div id={{ $game['slug'] }} class="absolute bottom-0 right-0 w-16 h-16 bg-gray-800 rounded-full"  style="right: -20px; bottom: -20px">
                    @push('scripts')
                        @include('_rating', [
                            'slug' => $game['slug'],
                            'rating' => $game['rating'],
                            'event' => null
                        ])
                    @endpush
                </div>
            @endif
        </div>
        <a href="#" class="block text-base font-semibold leading-tight hover:text-gray-400 mt-8">
            {{ $game['name'] }}
        </a>
        @if(isset($game['platforms']))
            <div class="text-gray-400 mt-1">
                {{ $game['platforms'] }}
            </div>
        @endif
    </div>
</div>
