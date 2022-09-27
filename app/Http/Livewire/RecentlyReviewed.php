<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class RecentlyReviewed extends Component {
    public $recentlyReviewedGames = [];

    public function loadRecentlyReviewed() {
        $current = Carbon::now()->timestamp;
        $before = Carbon::now()->subMonths(2)->timestamp;

        $recentlyReviewedGamesUnformatted = Http::withHeaders(config('services.igdb'))
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

        $this->recentlyReviewedGames = $this->formatForView($recentlyReviewedGamesUnformatted);

        collect($this->recentlyReviewedGames)->filter(function($game){
            return $game['rating'];
        })->each(function($game){
            $this->emit('reviewGameWithRatingAdded', [
                'slug' => 'review_'.$game['slug'],
                'rating' => $game['rating'] / 100
            ]);
        });
    }

    public function render() {
        return view('livewire.recently-reviewed');
    }

    private function formatForView($games) {
        return collect($games)->map(function($game){
            return collect($game)->merge([
                'coverImageUrl' => Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']),
                'rating' => isset($game['rating']) ? round($game['rating']) : null,
                'platforms' => isset($game['platforms']) ? collect($game['platforms'])->pluck('abbreviation')->implode(', ') : ''
            ]);
        })->toArray();
    }
}
