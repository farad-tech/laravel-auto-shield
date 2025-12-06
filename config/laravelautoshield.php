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

];