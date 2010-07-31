<?php defined('SYSPATH') or die('No direct script access.');

/**
 *  Encypted Cookie Extension.
 *  Adapted from  [Kohana Userguide Example](http://kohanaframework.org/guide/using.autoloading#class-extension),
 *	See this [commit](http://github.com/kohana/userguide/commit/e66bb9ac7be1230410cb748b23e7903223415cf7)
 *
 * @package    Jelly Auth
 * @author     Woody Gilk
 */
class Encrypted_Cookie extends Kohana_Cookie {

    /**
     * @var  mixed  default encryption instance
     */
    public static $encryption = 'default';

    /**
     * Sets an encrypted cookie.
     *
     * @uses  Cookie::set
     * @uses  Encrypt::encode
     */
     public static function encrypt($name, $value, $expiration = NULL)
     {
         $value = Encrypt::instance(Cookie::$encryption)->encode((string) $value);

         parent::set($name, $value, $expiration);
     }

     /**
      * Gets an encrypted cookie.
      *
      * @uses  Cookie::get
      * @uses  Encrypt::decode
      */
      public static function decrypt($name, $default = NULL)
      {
          if ($value = parent::get($name, NULL))
          {
              $value = Encrypt::instance(Cookie::$encryption)->decode($value);
          }

          return isset($value) ? $value : $default;
      }

} // End Cookie
