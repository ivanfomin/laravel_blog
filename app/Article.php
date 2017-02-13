<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['name', 'brief', 'img', 'content', 'user_id'];

    protected $primaryKey = 'id';
    public $incrementing = TRUE;

    public $timestamps = TRUE;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
