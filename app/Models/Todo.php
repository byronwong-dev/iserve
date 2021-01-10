<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Todo extends Model
{
    use HasFactory;

    protected $table = 'todos';

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'completed',
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter($query, $input)
    {
        // we assume that all the API handling is only these, else we will have a different handling for what is query-able
        if (isset($input['id'])) {
            $this->whereInOrEqual($query, 'id', $input['id']);
        }

        if (isset($input['userId'])) {
            $this->whereInOrEqual($query, 'user_id', $input['userId']);
        }

        if (isset($input['completed'])) {
            $this->whereInOrEqual($query, 'completed', $input['completed']);
        }

        if (isset($input['title'])) {
            $this->whereInOrEqual($query, 'title', $input['title']);
        }

        if (isset($input['query'])) {
            $query->where(function($q) use ($input){
                // so in future has more sections that can be searched
                $q->where(DB::raw('LOWER(title)'), 'like', '%' . strtolower($input['query']) .'%');
            });
        }
    }

    private function whereInOrEqual($query, $column_name, $input)
    {
        if (is_array($input)) {
            $query->whereIn($column_name, $input);
        } else{
            $query->where($column_name, $input);
        }
    }
}
