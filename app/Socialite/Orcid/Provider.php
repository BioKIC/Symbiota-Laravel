<?php

namespace App\Socialite\Orcid;

use GuzzleHttp\RequestOptions;
use Illuminate\Support\Arr;
use Laravel\Socialite\Two\InvalidStateException;
use SocialiteProviders\Manager\OAuth2\AbstractProvider;
use SocialiteProviders\Manager\OAuth2\User;

class Provider extends AbstractProvider {
    public const IDENTIFIER = 'ORCID';

    protected $scopes = ['/authenticate', 'openid'];

    protected $scopeSeparator = ' ';

    protected $base_uri = 'https://orcid.org/';

    protected $api_uri = 'https://pub.orcid.org/';

    protected $orcid;

    protected function getAuthUrl($state): string {
        return $this->buildAuthUrlFromBase($this->base_uri . 'oauth/authorize', $state);
    }

    protected function getTokenUrl(): string {
        return $this->base_uri . 'oauth/token';
    }

    /*
    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token) {
        $response = $this->getHttpClient()->get($this->api_uri . 'v3.0/' . $this->orcid . '/record', [
            RequestOptions::HEADERS => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user) {
        return (new User())->setRaw($user)->map([
            //'nickname' => $user['username'],
            'id' => $user['orcid-identifier']['path'],
            'name' => trim(
                ($user['person']['name']['given-names']['value'] ?? '') . ' ' .
                ($user['person']['name']['family-name']['value'] ?? '')
            ),
            'firstName' => $user['person']['name']['given-names']['value'] ?? null,
            'lastName' => $user['person']['name']['family-name']['value'] ?? null,
            'email' => $user['person']['emails']['email'][0]['email'] ?? '',
            //'avatar'   => $user['avatar_url'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function user() {
        if ($this->user) {
            return $this->user;
        }

        if ($this->hasInvalidState()) {
            throw new InvalidStateException();
        }

        $response = $this->getAccessTokenResponse($this->getCode());

        $this->orcid = Arr::get($response, 'orcid');

        $user = $this->getUserByToken(Arr::get($response, 'access_token'));

        return $this->userInstance($response, $user);
    }

    /*
    public static function additionalConfigKeys(): array {
        return ['instance_uri'];
    }*/
}
