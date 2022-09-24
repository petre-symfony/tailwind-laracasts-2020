<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ComingSoon extends Component {
    public $comingSoonGames = [];

    public function loadComingSoon(){
        $current = Carbon::now()->timestamp;

        $this->comingSoonGames = Http::withHeaders(config('services.igdb'))
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
    }

    public function render() {
        return view('livewire.coming-soon');
    }
}
