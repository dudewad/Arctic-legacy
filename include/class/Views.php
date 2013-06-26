<?php
/**
 * Author: Layton Miller
 * Contact: layton@newcarcity.com
 * Date: 5/30/13
 */

class Views {
    private function __construct(){}

    public static function dealerSelect(){
        $html = '<div class="dealer-select" data-component-view="dealer-select">
                        <input type="checkbox" value="" checked="checked" name="selectedDealers[]"/>
                        <div class="dealer-select-center">
                            <h4 class="dealer-select-title"></h4>
                            <div class="dealer-select-distance"></div>
                        </div>
                        <div class="dealer-select-right">
                            <div class="dealer-select-location">
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>';
        return $html;
    }
}
