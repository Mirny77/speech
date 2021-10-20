<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\QueryFilter;
class Provider extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function accounts()
    {
        return $this->hasMany(UserAccountProvider::class);
    }
    public function languages()
    {
        return $this->hasMany(Language::class);
    }
    public function voices()
    {
        return $this->hasMany(Voice::class);
    }
    public function formats()
    {
        return $this->hasMany(Format::class);
    }
    public function speeds()
    {
        return $this->hasMany(Speed::class);
    }
    public function emotions()
    {
        return $this->hasMany(Emotion::class);
    }
    public function scopeFilter(Builder $builder, QueryFilter $filter){
        return $filter->apply($builder);
    }
    
}
