<?php


namespace SocialiteProviders\Casdoor;


use   SocialiteProviders\Manager\SocialiteWasCalled;

class CasdoorExtendSocialite
{
    /**
     * Register the provider.
     *
     * @param \SocialiteProviders\Manager\SocialiteWasCalled $socialiteWasCalled
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite('casdoor', Provider::class);
    }
}
