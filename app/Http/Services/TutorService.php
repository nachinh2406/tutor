<?php

namespace App\Http\Services;

use App\Cache\SmartFilterCache;
use App\Models\ClassRegister;
use App\Models\User;

class TutorService
{
    protected $classRegister;

    public function __construct(ClassRegister $classRegister)
    {
        $this->classRegister = $classRegister;
    }

    /**
     * Get the products with the specified filters.
     *
     * @param array $filters
     * @return array
     */
    public function getTutors()
    {
        $classRegister = $this->classRegister;
        $filters = [
            "is_experienced"=>$classRegister->is_experienced,
            "is_university_top"=>$classRegister->is_university_top,
            "role_user"=>$classRegister->role_user,
            "district_id"=>$classRegister->district_id,
            "subject_id"=>$classRegister->subject_id,
            "class_id"=>$classRegister->class_id
        ];
        $cacheKey = $this->generateCacheKey($filters);
        $cache = new SmartFilterCache();
        // Try to get the results from the cache
        $results = $cache->get($cacheKey);

        if (!$results) {
            // If the results are not in the cache, perform the query and store the results in the cache
            $results = User::query()
                ->when($filters['is_experienced'], function ($q) {
                    return $q->whereNotNull('is_experience');
                })
                ->with(['school' => function($q) use($filters) {
                    $q->when($filters['is_university_top'], function ($q) use($filters) {
                        return $q->where('is_top',$filters['is_university_top']);
                    });
                }])
                ->where('position', $filters['role_user'])
                ->where('district_id', $filters['district_id'])
                ->where('subject_id',"like",'%'.'"'.$filters['subject_id'].'"'.'%')
                ->where('class_id',"like",'%'.'"'.$filters['class_id'].'"'.'%')
                ->get()
                ->toArray();
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
        return 'Tutors:' . md5(json_encode($filters));
    }
}

?>
