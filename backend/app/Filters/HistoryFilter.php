<?php

namespace App\Filters;
use Carbon\Carbon;
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
    public function start($date = ''){
        
        return $this->builder->when($date, function($query) use($date){
            $query->where('created_at','>=', Carbon::parse($date));
        });
    }
    public function end($date = ''){
        
        return $this->builder->when($date, function($query) use($date){
            $query->where('created_at','<=', Carbon::parse($date)->addDay());
        });
    }

    public function search($search_string = '+++'){
        return $this->builder
            ->where('text', 'ilike', '%'.$search_string.'%');
    }
    public function provider($id = null){
    
        return $this->builder->when($id, function($query) use($id){
            $query->where('id', $id);
        });
    }
}