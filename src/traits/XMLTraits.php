<?php

namespace Finoux\DB\traits;

trait XMLTraits{

    public function parseXML($filePath){
        return  $xml = simplexml_load_file($filePath);
     }
}