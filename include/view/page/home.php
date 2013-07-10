<?php
/**
 * Created by Ghost.
 * Date: 3/15/13
 * Time: 3:09 PM
 */

$nav = $this->nav();
$footer = $this->footer();

//Links
$home = $this->getURL("main");
$results = $this->getURL("results");
$images = $this->getURL("images");

$pageContent = <<<HTML
<section>

</section>
$footer

HTML;

/**
 * Generate page tooltips
 */
$tooltips = <<<HTML
<div class="tooltip-definitions">
    <div id="tooltip-picker" class="tooltip tooltip-frame">
        <div class="tooltip-frame-content">
            <h3>Tooltip</h3>
            <p>Tooltip content!!</p>
        </div>
    </div>
</div>
HTML;

?>