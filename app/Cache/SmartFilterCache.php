<?php
namespace App\Cache;

use Illuminate\Support\Facades\Cache;

class SmartFilterCache {
    /**
     * Store the results of a smart filter query in the cache for a specified amount of time.
     *
     * @param string $key
     * @param array $results
     * @param int $minutes
     * @return void
     */
    public function remember(string $key, array $results, int $minutes)
    {
        Cache::put($key, $results, $minutes);
    }

    /**
     * Retrieve the results of a smart filter query from the cache.
     *
     * @param string $key
     * @return array|null
     */
    public function get(string $key)
    {
        return Cache::get($key);
    }
}



?>
