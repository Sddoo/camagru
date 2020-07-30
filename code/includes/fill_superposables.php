<?php

require_once("/code/includes/include.php");

function fill_superposables() {
    $file_names = scandir("../superposable");
    foreach ($file_names as $key => $elem) {
        if (preg_match("/.*\.png$/", $elem))
            echo("<label class='spb'>
                      <input type='radio' name='spb' value={$elem}>
                      <img onclick='put_spb_to_video(this)' src='../superposable/{$elem}'>
                  </label>");
    }
}


?>