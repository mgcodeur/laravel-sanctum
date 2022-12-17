<?php

namespace Mgcodeur\LaravelSanctum\Models;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    protected $guarded = [];
    protected $table = 'verifications';

    public function verifiable()
    {
        return $this->morphTo();
    }
}
