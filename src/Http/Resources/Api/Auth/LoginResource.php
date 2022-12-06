<?php
namespace Mgcodeur\LaravelSanctum\Http\Resources\Api\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "access_token" => $this->createToken('api_token')->plainTextToken
        ];
    }
}
