<?php

namespace Jamesmills\LaravelNotificationRateLimit;

use Illuminate\Cache\RateLimiter;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

trait RateLimitedNotification
{
    /**
     * @param $instance
     * @param $user
     * @return string
     */
    public function throttleKey($instance, $user)
    {
        return Str::lower(
            class_basename($instance) . '|' . 1 . '|' . $user->id
        );
    }

    /**
     * The rate limiter instance
     * @return RateLimiter|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function limiter()
    {
        return app(RateLimiter::class);
    }

    /**
     * Max attempts to accept in the throttled timeframe
     * @return int
     */
    public function maxAttempts()
    {
        return 1;
    }

    /**
     * Time in seconds to throttle the notifications
     * @return int
     */
    public function throttleForSeconds()
    {
        return 60;
    }

    public function logSkippedNotifications()
    {
        return config('laravel-notification-rate-limit.log_skipped_notifications', true);
    }
}
