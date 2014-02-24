<?php
/**
 * Author: Layton Miller
 * Contact: layton@newcarcity.com
 * Date: 6/6/13
 */
 
class Utility_JSONGenerator {
    private final function __construct(){}

    public static function genFromResultSet($set){
        $json = "{";
        while($row = $set->fetch_assoc()){
            foreach($row as $key => $val){
                $json .= $key . ':"' . $val . '",';
            }
        }
        //Remove trailing comma
        $json = substr($json, 0, -1);
        $json .= "}";
        return $json;
    }

    //Currently this is non-recursive. It'll have to be updated before that is a functionality.
    public static function genFromObject($obj){
        $json = "{";
        foreach($obj as $key => $val){
            $json .= '"' . $key . '":"' . $val . '",';
        }
        //Remove trailing comma
        $json = substr($json, 0, -1);
        $json .= "}";
        return $json;
    }



    /**
     * echoDocument is necessary to wrap the json in a callback so this can be treated as a request and work cross-domain.
     * Note- the request must come in with a "cb" (short for "callback") variable specifying the client side callback
     * method to be executed on return.
     * @param $data     stdClass          An object whose key/val pairs are to be output to JSON.
     * @return string
     */
    public static function echoDocument($data){
        header("Content-type: application/json");
        $callback = isset($_REQUEST['cb']) ? $_REQUEST['cb'] : "";
        return $callback . "([" . json_encode($data) . "])";
    }
}