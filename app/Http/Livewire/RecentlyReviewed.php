<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class RecentlyReviewed extends Component {
    public $recentlyReviewedGames = [];

    public function loadRecentlyReviewed() {
        $current = Carbon::now()->timestamp;
        $before = Carbon::now()->subMonths(2)->timestamp;

        $this->recentlyReviewedGames = Http::withHeaders(config('services.igdb'))
            ->withBody(
                "fields name, cover.url, first_release_date, rating_count, platforms.abbreviation, rating, slug, summary;
                where platforms = (48, 49, 130, 6)
                & (first_release_date > {$before}
                & first_release_date < {$current}
                & cover != null
                & rating_count > 5
                );
                sort rating_count desc;
                limit 3;",
                "text/plain"
            )
            ->post('https://api.igdb.com/v4/games')
            ->json()
        ;
    }

    public function render() {
        return view('livewire.recently-reviewed');
    }
}
