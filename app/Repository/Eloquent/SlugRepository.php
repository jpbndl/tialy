<?php

namespace App\Repository\Eloquent;

use App\Slug;
use App\Repository\Paginate\PaginateRepository;
use App\Repository\Result\ResultMessage;

class SlugRepository extends ResultMessage {
    protected $withAll = [];

    public function __construct(PaginateRepository $paginateRepository) {
        $this->paginateRepository = $paginateRepository;
    }

    public function index($request) {
        return $this->paginateRepository->get(Slug::with($this->withAll), $request);
    }

    public function store($request) {
        if ($this->isExisting($request->slug)) 
            return $this->result(0, "Slug already exists");

        $slug = new Slug;
        
        $slug->slug = $request->slug;
        $slug->redirect = $request->redirect;
        
        return $this->result($slug->save(), "Slug has been created", $slug);
    }

    public function update($request, $id) {
        $slug = Slug::find($id);
        
        if ($slug) {
            $slug->slug = $request->slug;
            $slug->redirect = $request->redirect;
        } else {
            return $this->noRecordsFound();
        }

        return $this->result($slug->save(), "Slug has been updated", $slug);
    }

    public function destroy($id) {
        $slug = Slug::find($id);

        if($slug) {
            $result = $slug->delete();
            return $this->success($result,'Record successfully deleted with Id #: '. $slug->id, 200);
        } else {
            return $this->error('Deletion failed.', 500);
        }
    }

    public function show($id) {
        return Slug::where('id', $id)->get();
    }

    public function isExisting($slug) {
        return Slug::where('slug', $slug)->count() > 0 ? true : false;
    }
}

