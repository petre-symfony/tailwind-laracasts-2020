<div wire:init="loadPopularGames" class="popular-games text-sm grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6 gap-12 border-b border-gray-800 pb-16">
    {{--@forelse($popularGames as $game)
        <div class="game mt-8">
            <div class="relative inline-block">
                <a href="#">
                    <img src="{{ Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) }}" alt="game cover" class="hover:opacity-75 transition ease-in-out duration-150">
                </a>
                @if(isset($game['rating']))
                    <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-800 rounded-full"  style="right: -20px; bottom: -20px">
                        <div class="font-semibold text-xs flex justify-center items-center h-full">
                            {{ round($game['rating']).'%' }}
                        </div>
                    </div>
                @endif
            </div>
            <a href="#" class="block text-base font-semibold leading-tight hover:text-gray-400 mt-8">
                {{ $game['name'] }}
            </a>
            @if(isset($game['platforms']))
                <div class="text-gray-400 mt-1">
                    @foreach($game['platforms'] as $platform)
                        @if (isset($platform['abbreviation']))
                            {{ $platform['abbreviation'] }},
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    @empty --}}
        <div class="game mt-8">
            <div class="relative inline-block">
                <div>img goes here</div>
            </div>
            <div class="block text-base font-semibold leading-tight hover:text-gray-400 mt-8">
                title goes here
            </div>
            <div class="text-gray-400 mt-1">
                PS4, PC, Switch
            </div>
        </div>
    {{-- @endforelse --}}
</div>