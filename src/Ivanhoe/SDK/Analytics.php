<?php
namespace Ivanhoe\SDK;

/**
 * Class Analytics
 * Helpers for working with google analytics
 * @package Ivanhoe\SDK
 */
class Analytics
{
    /**
     * Get google analytics profile id
     * https://developers.google.com/analytics/devguides/collection/analyticsjs/cookies-user-id
     * Use only on web environment, it won't work on cli
     * Returns
     *
     * @return string|bool
     * @throws \RuntimeException
     * @throws AnalyticsException
     */
    public static function getProfileId()
    {
        if (PHP_SAPI === 'cli') {
            throw new \RuntimeException(sprintf('%s::%s can not be used on cli environment', __CLASS__, __FUNCTION__));
        }
        $cookieKey = Settings::GOOGLE_PROFILE_COOKIE;
        $google_client_id = filter_input(INPUT_COOKIE, $cookieKey, FILTER_VALIDATE_REGEXP, ['options' => [
            'regexp' => '/^GA\d\.\d.\d+\.\d+/'
        ]]);
        if (!$google_client_id) {
            throw new AnalyticsException(sprintf('Invalid %s cookie.', $cookieKey));
        }
        return $google_client_id;
    }
}