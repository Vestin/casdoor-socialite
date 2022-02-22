# Casdoor

```bash
composer require vestin/casdoor-socialite
```

## Installation & Basic Usage

Please see the [Base Installation Guide](https://socialiteproviders.com/usage/), then follow the provider specific instructions below.

### Add configuration to `config/services.php`

```php
'casdoor' => [    
  'client_id' => env('CASDOOR_CLIENT_ID'),  
  'client_secret' => env('CASDOOR_CLIENT_SECRET'),  
  'redirect' => env('CASDOOR_REDIRECT_URI'),
  'url' => env('CASDOOR_URL')
],
```

`url` is baseUrl of casdoor, eg: `http://domain.com`

### Add provider event listener

Configure the package's listener to listen for `SocialiteWasCalled` events.

Add the event to your `listen[]` array in `app/Providers/EventServiceProvider`. See the [Base Installation Guide](https://socialiteproviders.com/usage/) for detailed instructions.

```php
protected $listen = [
    \SocialiteProviders\Manager\SocialiteWasCalled::class => [
        // ... other providers
        \SocialiteProviders\Casdoor\CasdoorExtendSocialite::class.'@handle',
    ],
];
```

### Usage

You should now be able to use the provider like you would regularly use Socialite (assuming you have the facade installed):

```php
return Socialite::driver('casdoor')->redirect();
```

### Returned User fields

- ``id``
- ``openid``
- ``name``
...

see more https://casdoor.org/docs/basic/core-concepts/#user