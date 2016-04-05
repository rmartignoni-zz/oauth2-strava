# oauth2-strava
Strava OAuth2 Client

```php

$client = new \rmartignoni\OAuth2\Strava\Client\Provider\Strava([
    'clientId'     => '[your_client_id]',
    'clientSecret' => '[your_client_secret]',
    'redirectUri'  => '[redirect_uri]',
], []);

if (!isset($_GET['code'])) {
    $authorizationUrl = $client->getAuthorizationUrl(['approval_prompt' => 'force']);

    $_SESSION['oauth2state'] = $client->getState();

    header('Location:' . $authorizationUrl);
    exit;
}

if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    unset($_SESSION['oauth2state']);

    throw new \Exception;
}

$accessToken = $client->getAccessToken('authorization_code', [
    'code' => $_GET['code'],
]);

echo $accessToken->getToken();

```
