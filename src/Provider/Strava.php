<?php

    namespace rmartignoni\OAuth2\Strava\Client\Provider;

    use League\OAuth2\Client\Provider\AbstractProvider;
    use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
    use League\OAuth2\Client\Provider\ResourceOwnerInterface;
    use League\OAuth2\Client\Token\AccessToken;
    use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
    use Psr\Http\Message\ResponseInterface;
    use rmartignoni\OAuth2\Strava\Client\Scope;

    class Strava extends AbstractProvider
    {
        use BearerAuthorizationTrait;

        public function __construct(array $options, array $collaborators)
        {
            parent::__construct($options, $collaborators);
        }

        private function getBaseUrl()
        {
            return 'https://www.strava.com/oauth';
        }

        /**
         * Returns the base URL for authorizing a client.
         *
         * Eg. https://oauth.service.com/authorize
         *
         * @return string
         */
        public function getBaseAuthorizationUrl()
        {
            return $this->getBaseUrl() . '/authorize';
        }

        /**
         * Returns the base URL for requesting an access token.
         *
         * Eg. https://oauth.service.com/token
         *
         * @param array $params
         *
         * @return string
         */
        public function getBaseAccessTokenUrl(array $params)
        {
            return $this->getBaseUrl() . '/token';
        }

        /**
         * Returns the URL for requesting the resource owner's details.
         *
         * @param AccessToken $token
         *
         * @return string
         */
        public function getResourceOwnerDetailsUrl(AccessToken $token)
        {
            // TODO: Implement getResourceOwnerDetailsUrl() method.
        }

        /**
         * Returns the default scopes used by this provider.
         *
         * This should only be the scopes that are required to request the details
         * of the resource owner, rather than all the available scopes.
         *
         * @return array
         */
        protected function getDefaultScopes()
        {
            return [Scope::READ_ONLY];
        }

        /**
         * Checks a provider response for errors.
         *
         * @throws IdentityProviderException
         *
         * @param  ResponseInterface $response
         * @param  array|string      $data Parsed response data
         *
         * @return void
         */
        protected function checkResponse(ResponseInterface $response, $data)
        {
            $code = $response->getStatusCode();

            if($code > 400) {
                throw new IdentityProviderException(
                    isset($data['error']) ? $data['error'] : $response->getReasonPhrase(),
                    $response->getStatusCode(),
                    $response->getBody()
                );
            }
        }

        /**
         * Generates a resource owner object from a successful resource owner
         * details request.
         *
         * @param  array       $response
         * @param  AccessToken $token
         *
         * @return ResourceOwnerInterface
         */
        protected function createResourceOwner(array $response, AccessToken $token)
        {
            // TODO: Implement createResourceOwner() method.
        }
    }
