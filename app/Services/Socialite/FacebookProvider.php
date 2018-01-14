<?php
/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 22/06/17
 * Time: 02:36
 */

namespace App\Services\Socialite;

class FacebookProvider extends \Laravel\Socialite\Two\FacebookProvider
{
    protected function parseAccessToken($body)
    {
        parse_str($body);
        $json = json_decode($body);

        return $json->access_token;
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get($this->graphUrl.'/'. $this->version .'/me?access_token='.$token . '&fields=first_name,last_name,email,id', [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}