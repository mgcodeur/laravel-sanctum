<?php
namespace Mgcodeur\LaravelSanctum\Observers\Api\Auth;

use Illuminate\Support\Facades\Mail;
use Mgcodeur\LaravelSanctum\Mail\Api\Auth\SendVerificationLink;

class UserObserver
{
    public function creating($user) {
    }
    /**
     * Handle the User "created" event.
     * @return void
     */
    public function created($user)
    {
        $user->sendEmailVerificationLink();

    }

    public function updating($user) {

    }

    /**
     * Handle the User "updated" event.
     * @return void
     */
    public function updated($user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     * @return void
     */
    public function deleted($user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     * @return void
     */
    public function restored($user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     * @return void
     */
    public function forceDeleted($user)
    {
        //
    }


    private function sendVerificationLink($user) {

    }
}