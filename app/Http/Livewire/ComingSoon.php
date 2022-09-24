<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class ComingSoon extends Component {
    public $comingSoonGames = [];

    public function loadComingSoon(){
        $current = Carbon::now()->timestamp;

        $comingSoonGamesUnformatted = Http::withHeaders(config('services.igdb'))
            ->withBody(
                "fields name, cover.url, first_release_date, total_rating_count, platforms.abbreviation, rating, slug;
                where platforms = (48, 49, 130, 6)
                & (first_release_date > {$current}
                & cover != null
                & age_ratings.rating > 4
                );
                sort first_release_date asc;
                limit 4;",
                "text/plain"
            )
            ->post('https://api.igdb.com/v4/games')
            ->json()
        ;

        $this->comingSoonGames = $this->formatForView($comingSoonGamesUnformatted);
    }

    public function render() {
        return view('livewire.coming-soon');
    }

    private function formatForView($games) {
        return collect($games)->map(function($game){
            return collect($game)->merge([
                'coverImageUrl' => Str::replaceFirst('thumb', 'cover_small', $game['cover']['url']),
                'releaseDate' => Carbon::parse($game['first_release_date'])->format('M d, Y')
            ]);
        })->toArray();
    }
}
