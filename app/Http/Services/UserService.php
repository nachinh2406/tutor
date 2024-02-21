<?php
namespace App\Services;

use App\Cache\SmartFilterCache;

class UserService
{
    /**
     * Get the products with the specified filters.
     *
     * @param array $filters
     * @return array
     */
    public function getProducts(array $filters)
    {
        $cacheKey = $this->generateCacheKey($filters);
        $cache = new SmartFilterCache();

        // Try to get the results from the cache
        $results = $cache->get($cacheKey);

        if (!$results) {
            // If the results are not in the cache, perform the query and store the results in the cache
            // $results = Product::query()
            //     ->where('price', '>=', $filters['min_price'])
            //     ->where('price', '<=', $filters['max_price'])
            //     ->orderBy('created_at', 'desc')
            //     ->get()
            //     ->toArray();

            $cache->remember($cacheKey, $results, 60);
        }

        return $results;
    }

    /**
     * Generate a cache key for the specified filters.
     *
     * @param array $filters
     * @return string
     */
    private function generateCacheKey(array $filters)
    {
        return 'products:' . md5(json_encode($filters));
    }
}
?>
