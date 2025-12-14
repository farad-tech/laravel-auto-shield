<?php

return [

    /**
     * Enable or disable Laravel Auto Shield
     * ------------------------------------------------
     * true  => Auto Shield is active and will monitor IPs
     * false => Auto Shield is inactive and will do nothing
     */
    'enabled' => true,

    /**
     * Determine the type of IP check
     * ------------------------------------------------
     * true  => Use the client's real IP address (supports proxies/load balancers)
     * false => Use the server's REMOTE_ADDR
     *
     * To get the real IP manually, you can use the helper function `autoShieldRealIp()`.
     */
    'based_on_real_ip' => true,

    /**
     * Periodic request analysis window (in seconds)
     * ------------------------------------------------
     * Auto Shield compares the number of requests in this period
     * with the previous period to detect abnormal spikes.
     *
     * Example:
     * If set to 60 → system compares the last 60s vs the 60s before that.
     */
    'period_range' => 60,

    /**
     * Sensitivity ratio for abnormal request growth
     * ------------------------------------------------
     * If the request count in the current period grows by this multiplier
     * compared to the previous one, Auto Shield will trigger a warning
     * or take action.
     *
     * Example:
     * 3 => current requests are 3x more than previous period.
     */
    'increasing_ratio' => 3,

    /**
     * Remove old request logs
     * ------------------------------------------------
     * true  => Auto Shield deletes request records older than `remove_old_request_seconds`
     * false => Keeps all records without purging
     */
    'remove_old_request_records' => true,

    /**
     * Time limit for old request cleanup (in seconds)
     * ------------------------------------------------
     * Records older than this value will be deleted if cleanup is enabled.
     *
     * Example:
     * 21600 seconds = 6 hours
     */
    'remove_old_request_seconds' => 21600,

    /**
     * Queue name for security notifications
     * ------------------------------------------------
     * If set to a queue name (string), notifications will be dispatched
     * to that queue.
     *
     * If null => notifications are sent synchronously (without queue).
     */
    'send_notification_queue_name' => null,

];
