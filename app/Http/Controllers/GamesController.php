<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GamesController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // For Multi Query
        // $client = new \GuzzleHttp\Client(['base_uri' => 'https://api-v3.igdb.com/']);

        // $response = $client->request('POST', 'multiquery', [
        //     'headers' => [
        //         'user-key' => env('IGDB_KEY'),
        //     ],
        //     'body' => '
        //         query games "Playstation" {
        //             fields name, popularity, platforms.name, first_release_date;
        //             where platforms = {6,48,130,49};
        //             sort popularity desc;
        //             limit 2;
        //         };

        //         query games "Switch" {
        //             fields name, popularity, platforms.name, first_release_date;
        //             where platforms = {6,48,130,49};
        //             sort popularity desc;
        //             limit 6;
        //         };
        //         '
        // ]);

        // $body = $response->getBody();
        // dd(json_decode($body));

        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug) {
        $game = Http::withHeaders(config('services.igdb'))
            ->withBody(
                "fields name, cover.url, first_release_date, age_ratings.rating, platforms.abbreviation,
                slug, involved_companies.company.name, genres.name, aggregated_rating, summary, websites.*,
                videos.*, screenshots.*, similar_games.cover.url, similar_games.name, similar_games.rating,
                similar_games.platforms.abbreviation, similar_games.slug, rating;
                where slug=\"{$slug}\";
                ",
                "text/plain"
            )
            ->post('https://api.igdb.com/v4/games')
            ->json()
        ;

        abort_if(!$game, 404);


        return view('show', [
            'game' => $this->formatGameForView($game[0])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    private function formatGameForView($game){
        return collect($game)->merge([
            'coverImageUrl' => Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']),
            'genres' => collect($game['genres'])->pluck('name')->implode(', '),
            'involvedCompanies' => $game['involved_companies'][0]['company']['name'],
            'platforms' => collect($game['platforms'])->pluck('abbreviation')->implode(', '),
            'memberRating' => isset($game['rating']) ? round($game['rating']) : '0',
            'criticRating' => isset($game['aggregated_rating']) ? round($game['aggregated_rating']) : '0',
            'trailer' => 'https://youtube.com/embed/' . $game['videos'][0]['video_id'],
            'screenshots' => collect($game['screenshots'])->map(function($screenshot) {
                return [
                    'huge' => Str::replaceFirst('thumb', 'screenshot_huge', $screenshot['url']),
                    'big' => Str::replaceFirst('thumb', 'screenshot_big', $screenshot['url'])
                ];
            })->take(9),
            'similar_games' => collect($game['similar_games'])->map(function($game){
                return collect($game)->merge([
                    'coverImageUrl' => isset($game['cover']) ? Str::replaceFirst('thumb', 'cover_big', $game['cover']['url'])
                        : 'https://via.placeholder.com/264x352',
                    'rating' => isset($game['rating']) ? round($game['rating']) : null,
                    'platforms' => isset($game['platforms']) ? collect($game['platforms'])->pluck('abbreviation')->implode(', ')
                        : null
                ]);
            })->take(6),
            'social' => [
                'website' => collect($game['websites'])->first(),
                'facebook' => collect($game['websites'])->filter(function ($website) {
                    return Str::contains($website['url'], 'facebook');
                })->first(),
                'twitter' => collect($game['websites'])->filter(function ($website) {
                    return Str::contains($website['url'], 'twitter');
                })->first(),
                'instagram' => collect($game['websites'])->filter(function ($website) {
                    return Str::contains($website['url'], 'instagram');
                })->first()
            ]
        ]);
    }
}
