<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class CacheApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'characters:api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calls Marvel API and saves response to CACHE';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $ts = time();
        $hash = md5($ts . config('marvelCharacters.private_key'). config('marvelCharacters.public_key') );

        $client = Http::get('http://gateway.marvel.com/v1/public/characters', [
            'apikey' => config('marvelCharacters.public_key'),
            'ts' => $ts,
            'hash' => $hash
        ]);

        $endpoint = 'characters';

        $results_per_page = 20;

        $total_page_count = 10;

        $minutes_to_cache = 1440; // caches the results per day

        $data = [];

        for($x = 0; $x <= $total_page_count; $x++){

            //$query = $client->json();
            $query = $client->json()['data'];

            $query['offset'] = $results_per_page * $x;

            $response = $client->json('http://gateway.marvel.com/v1/public/' . $endpoint, ['query' => $query]);

            $current_data = $response['query']['results'];

            $data = array_merge($data, $current_data);
        }

        Cache::put($endpoint, $data, $minutes_to_cache);

        echo "Done \n";

        return 0;
    }
}
