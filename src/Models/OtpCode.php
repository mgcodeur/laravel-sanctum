<?php
namespace Mgcodeur\LaravelSanctum\Models;

use Illuminate\Database\Eloquent\Model;
use Mgcodeur\LaravelSanctum\Facades\LaravelSanctum;

class OtpCode extends Model
{
    protected $guarded = [];
    protected $table = 'otp_codes';
    public $timestamps = false;

    public function user() {
        return $this->belongsTo(LaravelSanctum::getAuthModel());
    }
}
