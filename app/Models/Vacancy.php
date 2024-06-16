<?php

namespace App\Models;

use Coderflex\Laravisit\Concerns\CanVisit;
use Coderflex\Laravisit\Concerns\HasVisits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacancy extends Model implements CanVisit 
{
    use HasFactory;
    Use Commentable;
    use SoftDeletes;
    use HasVisits;

    protected $fillable = [
        //'user_id', // This is only a temporary measurre while we dont have other relationships in place.
        'user_id',
        'title',
        'body',
        'time_to_read',
        'is_published',
        'priority',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    
}
