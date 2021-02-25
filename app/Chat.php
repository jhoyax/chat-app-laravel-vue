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
     * @param   mixed  $name
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
     * Scope a query to filter by from
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param   mixed  $from
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterByFrom($query, $from)
    {
        if ($from) {
            return $query->where('from', $from);
        }

        return $query;
    }

    /**
     * Scope a query to filter by to
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param   mixed  $to
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterByTo($query, $to)
    {
        if ($to) {
            return $query->where('to', $to);
        }

        return $query;
    }

    /**
     * Scope a query to group chat by from
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param   mixed  $from
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGroupChatByFrom($query, $from)
    {
        if ($from) {
            return $query->whereIn('id', function ($query) use ($from) {
                $query->selectRaw('max(c.id)')
                    ->from('chats as c')
                    ->where('from', $from)
                    ->groupByRaw('c.from, c.to');
            });
        }

        return $query;
    }

    /**
     * Scope a query to get all chat by from and to
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param   mixed  $from
     * @param   mixed  $to
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGetAllChatByFromAndTo($query, $from, $to)
    {
        if ($from && $to) {
            return $query->where(function ($query) use ($from, $to) {
                $query->filterByFrom($from)->filterByTo($to);
            })->orWhere(function ($query) use ($from, $to) {
                $query->filterByFrom($to)->filterByTo($from);
            });
        }

        return $query;
    }
}
