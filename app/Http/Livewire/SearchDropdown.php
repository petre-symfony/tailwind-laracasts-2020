<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropdown extends Component {
    public $search = '';
    public $searchResults = [];

    public function render() {
        $this->searchResults = Http::withHeaders(config('services.igdb'))
            ->withBody(
                    "search \"{$this->search}\";
                    fields name, slug, cover.url;
                    limit 6;",
                "text/plain"
            )
            ->post('https://api.igdb.com/v4/games')
            ->json()
        ;

        dump($this->searchResults);
        return view('livewire.search-dropdown');
    }
}
