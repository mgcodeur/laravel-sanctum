<?php

namespace Mgcodeur\LaravelSanctum\Models;

class Media extends \Illuminate\Database\Eloquent\Model
{
    protected $guarded = [];
    protected $table = 'media';

    public function mediable() {
        return $this->morphTo();
    }
}
