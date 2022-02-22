<?php


namespace SocialiteProviders\Casdoor;


use GuzzleHttp\RequestOptions;
use Lcobucci\JWT\Parser;
use SocialiteProviders\Manager\OAuth2\AbstractProvider;
use SocialiteProviders\Manager\OAuth2\User;

class Provider extends AbstractProvider
{
    /**
     * Unique Provider Identifier.
     */
    public const IDENTIFIER = 'CASDOOR';

    /**
     * {@inheritdoc}
     */
    protected $scopes = ['read'];

    /**
     * {@inheritdoc}
     */
    public static function additionalConfigKeys()
    {
        return ['url'];
    }

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase($this->getUrl().'/api/oauth/access_token', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return $this->getUrl().'/api/login/oauth/access_token';
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $parser = new Parser();
        $jwtToken = $parser->parse($token);
        return $jwtToken->getClaims();
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        $data = [];
        foreach ($user as $key => $valueObj){
            $data[$key] = $valueObj->getValue();
        }
        return (new User())->setRaw($user)->map($data);
    }

    /**
     * @return url of casdoor
     */
    protected function getUrl(){
        return rtrim($this->getConfig('url'),'/');
    }

}
