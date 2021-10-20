<?php

namespace App\Filters;

class HistoryFilter extends QueryFilter{
    public function provider_id($id = null){
        
        return $this->builder->when($id, function($query) use($id){
            $query->where('provider_id', $id);
        });
    }
    public function lang($lang = ''){
        
        return $this->builder->when($lang, function($query) use($lang){
            $query->where('lang', $lang);
        });
    }


    public function search($search_string = ''){
        return $this->builder
            ->where('text', 'LIKE', '%'.$search_string.'%');
    }
}