<?php

namespace NosoProject\Methods;


final class CheckAccesClaim
{

    /**
     * Check whether it is possible to show a claim
     */
    static function run($lastclaim)
    {
        return ($lastclaim + $_ENV['CLAIM_TIME']) < time() ? true : false;
    }
}
