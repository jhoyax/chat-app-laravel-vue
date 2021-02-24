<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from', 'to', 'to_name', 'message',
    ];

    /**
     * Scope a query to filter by to_name
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param mixed $name
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterByToName($query, $name)
    {
        if ($name) {
            return $query->where('to_name', 'like', '%' . $name . '%');
        }

        return $query;
    }

    /**
     * Scope a query to filter by from and to
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param mixed $name
     * @param mixed $from
     * @param mixed $to
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterByFromAndTo($query, $from, $to)
    {
        if ($from && $to) {
            return $query->where('from', $from)->where('to', $to);
        }

        return $query;
    }
}
