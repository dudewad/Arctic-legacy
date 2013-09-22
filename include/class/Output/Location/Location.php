<?php
/**
 * Author: Ghost
 * Date: 9/2/13
 */
class Output_Location_Location implements Interface_OutputBase{
    private $data;

    public function __construct(Location_Location $data){
        $this->data = $data;
    }



    /**
     * Format the a JSON representation of this object, typically for AJAX calls
     * @return string
     */
    public function to_JSON(){
        return json_encode($this->data->to_object());
    }



    /**
     * Format the full version of the object to HTML - a multi-line string
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_full($class = null){
        $placeName = $this->data->getName();
        $address = $this->data->getAddress();
        $city = $this->data->getCity();
        $state = $this->data->getState();
        $zip = $this->data->getZip();

        $html = <<<HTML
            $placeName<br />
            $address<br />
            $city $state $zip
HTML;

        return $html;
    }



    /**
     * Format the thumbnail version of the object to HTML - a one-line string
     * @param $class    String      The class of the outer-most HTML container element
     * @return string
     */
    public function to_html_thumb($class = null){
        $placeName = $this->data->getName();
        $address = $this->data->getAddress();
        $city = $this->data->getCity();
        $state = $this->data->getState();
        $zip = $this->data->getZip();

        $html = <<<HTML
            $placeName - $address $city $state $zip
HTML;

        return $html;
    }
}
