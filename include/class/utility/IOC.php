<?php
/**
 * Author: Layton Miller
 * Contact: layton@newcarcity.com
 * Date: 5/22/13
 */
 
class Utility_IOC {
    //Registry. Contains all registered classes
    protected static $registry = array();

    /**
     * Add a resolver to the registry
     * @param $name     String      The name of the class to add to the registry
     * @param callable $resolver    The closure to call when instantiating the class
     * @throws Exception            -Class already registered on duplicate class registration attempt
     */
    public static function register($name, Closure $resolver){
        if(array_key_exists($name, static::$registry)){
            throw new Exception("Class already registered: <strong>[$name]</strong>");
        }
        static::$registry[$name] = $resolver;
    }



    /**
     * Get a new object by specified name
     * @param String        $name   The name of the class to build
     * @param Array|null    $args   Any arguments to pass to the object being built
     * @return mixed                The requested class
     * @throws Exception            -No class by the supplied name is registered
     */
    public static function build($name, $args = null){
        if(static::is_registered($name)){
            $name = static::$registry[$name];
            return $name($args);
        }
        throw new Exception("No class registered by the name of [$name]");
    }



    /**
     * Check to see if a class has been registered
     * @param String $name     The name of the class being checked
     * @return bool
     */
    public static function is_registered($name){
        return array_key_exists($name, static::$registry);
    }
}
