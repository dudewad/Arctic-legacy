<?php
/**
 * Author: Layton Miller
 * Contact: layton@newcarcity.com
 * Date: 6/6/13
 */
 
class JSONGenerator {
    public function __construct(){}

    public function genFromResultSet($set){
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
    public function genFromObject($obj){
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
     * echoDocument is necessary to wrap the json in a callback so this can be treated as a request and work cross-domain
     * @param $json
     * @return string
     */
    public function echoDocument($json){
        return $_REQUEST['callback'] . "([" . $json . "])";
    }
}
