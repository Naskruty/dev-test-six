<?php

namespace Naskruty\DevTestSix\Component;

class Import
{

    public function importPages($url){

        if (empty($url)){
            return false;
        }
        $array = json_decode(json_encode(simplexml_load_file($url) ), TRUE);

        return;

    }
    public function generatePagesArray($url)
    {
        return;
    }



}