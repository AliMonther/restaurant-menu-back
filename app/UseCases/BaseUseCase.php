<?php

namespace App\UseCases;



class BaseUseCase
{



    public function __construct(){


    }


    /**
     * @param $actualValue
     * @param $correctResult
     * @param $exception
     * @param null $message
     * @return bool
     */
    public static function isPrimitiveResult($actualValue , $correctResult   , $exception , $message = null): bool
    {
        if($correctResult !== $actualValue){
           throw new $exception($message);
        }
        return true;

    }


    /**
     * @param $actualValue
     * @param $exception
     * @param null $message
     * @param int $code
     * @return bool
     */
    public static function isObject($actualValue , $exception , $message = null, $code = 400): bool
    {
        if( is_object($actualValue)) {
            return true;
        }
         throw new $exception($message,null,$code);

    }


    /**
     * @param $actualValue
     * @param $correctResult
     * @param $exception
     * @param null $message
     * @return bool
     */
    public static function isCustomObject($actualValue , $correctResult , $exception , $message = null): bool
    {
        if($actualValue instanceof $correctResult) {
            return true;
        }
         throw new $exception($message);

    }


    /**
     * @param $actualValue
     * @param $exception
     * @param null $message
     * @return bool
     */
    public static function isArray($actualValue , $exception , $message = null): bool
    {
        if(is_array($actualValue)) {
            return true;
        }
         throw new $exception($message);

    }


}
