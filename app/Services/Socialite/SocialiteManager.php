<?php
/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 22/06/17
 * Time: 02:34
 */

namespace App\Services\Socialite;

class SocialiteManager extends \Laravel\Socialite\SocialiteManager
{
    /**
     * Create an instance of the specified driver.
     *
     * @return \Laravel\Socialite\Two\AbstractProvider
     */
    protected function createFacebookDriver()
    {
        $config = $this->app['config']['services.facebook'];

        return $this->buildProvider(
            FacebookProvider::class, $config
        );

    }
}