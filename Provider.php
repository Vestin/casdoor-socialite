<?php


namespace SocialiteProviders\Casdoor;


use GuzzleHttp\RequestOptions;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\Encoding\JoseEncoder;
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
        return $this->buildAuthUrlFromBase($this->getUrl().'/login/oauth/authorize', $state);
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
        $jwtToken = (new Parser(new JoseEncoder()))->parse($token);
        return $jwtToken->claims()->all();
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        $data = [];
        foreach ($user as $key => $valueObj){
            $data[$key] = $valueObj;
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
