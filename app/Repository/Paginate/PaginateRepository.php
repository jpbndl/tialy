<?php

namespace App\Repository\Paginate;

class PaginateRepository {
    protected $model;

    public function get($model, $request) {
        if (!is_object($model)) {
            // instatiate to allow extension
            $model = $model::whereRaw('1 = 1');      
        }
        
        $per_page = $request->per_page ?: 0;

        if ($request->sortBy) {
            $model = $model->orderBy($request->sortBy, $this->desc($request->descending)); 
        } 

        if ($per_page == 0) {
            return $model->get();
        } else {
            return $model->paginate($per_page);
        }
    }

    public function desc($desc) {
        return $desc ? 'desc' : 'asc';
    }
}

?>