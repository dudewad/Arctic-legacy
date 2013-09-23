<?php
/**
 * Author: Ghost
 * Date: 9/11/13
 */
 
class Module_Social {
    public function __construct(){

    }


    /**
     * Outputs a dropdown allowing the user to select whether they are attending or not
     * @param eid Integer   Required        The event id
     * @param uid Integer   Required        The user id
     */
    public function select_event_attendance($eid, $uid){
        $yes = String_String::getString("OPTION_ATTENDING",__CLASS__);
        $no = String_String::getString("OPTION_MAYBE",__CLASS__);
        $maybe = String_String::getString("OPTION_NOT_ATTENDING",__CLASS__);


        $html = <<<HTML
            <form>
                <label for="attending"></label>
                <select name="attending">
                    <option value="1">$yes</option>
                    <option value="2">$maybe</option>
                    <option value="0">$no</option>
                </select>
                <input type="submit" name="attendingSubmit" value=""/>
            </form>
HTML;
    }
}
