<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class History extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function scopeFilter(Builder $builder, QueryFilter $filter){
        return $filter->apply($builder);
    }
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
