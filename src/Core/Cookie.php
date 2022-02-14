<?php
namespace NosoProject\Core;

use Dflydev\FigCookies\SetCookie;
use Dflydev\FigCookies\FigResponseCookies;
use Dflydev\FigCookies\FigRequestCookies;
use Carbon\Carbon;

 /**
  * Mini wrap for use dflydev/fig-cookies 
  */

final class Cookie{

    static function get($request, $key, $default = null) {
        $cookie = FigRequestCookies::get($request, $key,$default);
        return !$cookie->getValue() ? null :   htmlspecialchars($cookie->getValue(), ENT_QUOTES);
    }

    static function add($response, $key, $value, $expire_val, $expire_unit) {
        $offset = Carbon::now()->add($expire_val, $expire_unit);

        return FigResponseCookies::set($response, SetCookie::create($key)
		->withValue($value)
        ->withExpires($offset->toCookieString())
		->withPath('/')
        ->withSecure(false)
        ->withHttpOnly(true)
	);

    }

    static function remove($response, $key){
        return FigResponseCookies::set($response, SetCookie::create($key)
		->withValue(null)
        ->withExpires('Tue, 22-Jan-2002 22:22:22 GMT')
		->withPath('/')
	);
    }
}

