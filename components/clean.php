<?php
    // function to proof the input
    function clean($data){
        $data = trim($data);    //trims it
        $data = htmlspecialchars($data);  //converts the specialchars in html  carachters
        $data = strip_tags($data);  //strip the tags
        return $data;
    }