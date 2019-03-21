<?php
namespace camaleon\helpers;

class UrlGeneratorFacade{
    private static $urlGeneratorObj;
    public static function getInstanceURLGenerator(){
        if (! self::$urlGeneratorObj){        
            self::$urlGeneratorObj = new UrlGenerator();
            //ResourceBundleV2::writeDebugLOG('002', "FROM:: CONFIG-APP, se instancio URLGENERATOR ");
        }
    return self::$urlGeneratorObj;
    }
}