<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    protected $fillable = ['title', 'preview', 'description', 'active'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function toggle()
    {
        $this->update(['active' => !$this->active]);
    }
}
