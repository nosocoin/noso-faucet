<?php

namespace NosoProject\Methods;


final class CheckAccesClaim
{

    /**
     * Check whether it is possible to show a claim
     */
    static function run($lastclaim,$settings)
    {
        return ($lastclaim + $settings['CLAIM_TIME']) < time() ? true : false;
    }
}
