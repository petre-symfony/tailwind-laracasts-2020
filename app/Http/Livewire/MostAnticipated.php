<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class MostAnticipated extends Component {
    public $mostAnticipatedGames = [];

    public function loadMostAnticipated(){
        $current = Carbon::now()->timestamp;
        $afterFourMonths = Carbon::now()->addMonths(4)->timestamp;

        $mostAnticipatedGamesUnformatted = Http::withHeaders(config('services.igdb'))
            ->withBody(
                "fields name, cover.url, first_release_date, total_rating_count, platforms.abbreviation, rating, slug;
                where platforms = (48, 49, 130, 6)
                & (first_release_date > {$current}
                & first_release_date < {$afterFourMonths}
                & cover != null
                & age_ratings.rating > 8
                );
                sort total_rating_count;
                limit 4;",
                "text/plain"
            )
            ->post('https://api.igdb.com/v4/games')
            ->json()
        ;

        $this->mostAnticipatedGames = $this->formatForView($mostAnticipatedGamesUnformatted);
    }

    public function render() {
        return view('livewire.most-anticipated');
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
