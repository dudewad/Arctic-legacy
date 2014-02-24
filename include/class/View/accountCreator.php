<?php
/**
 * Tánguer "Account creation flow" view
 */
class View_AccountCreator extends View_View{
    public function __construct(){
        parent::__construct();

        //Generate the view
        $viewData = <<<HTML
HTML;

        //Return view data
        $this->setBuffer($viewData);
    }
}
?>