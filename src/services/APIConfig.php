<?php 

namespace Finoux\DB\services;

use Finoux\DB\traits\XMLTraits;
use Carbon\Carbon;
use DOMDocument;
use Illuminate\Support\Facades\Cache;
use SoapBox\Formatter\Formatter;

class APIConfig {
    
    use XMLTraits;
    
    public function getAPIConfig(){
        $expiresAt = Carbon::now()->endOfDay();
        return Cache::remember('APIMapping', $expiresAt, function () {
            return $this->parseAPIXML();
        });
       
    }

    private function parseAPIXML(){

        $xmlDoc = new DOMDocument();
        $xmlDoc->load(config("app.APIMappingURL"));
        $searchNode = $xmlDoc->getElementsByTagName( "api" );
        $apis = [];
        foreach( $searchNode as $searchNode )
        {
            $api = [];
            $apiName = $searchNode->getAttribute('name');
            
            $xmlMethod = $searchNode->getElementsByTagName( "method" );
            $api['method']['name']  = $xmlMethod->item(0)->getAttribute("name");
            $api['method']['classsname'] =  $xmlMethod->item(0)->getAttribute("classname");
          

            $xmlSp = $searchNode->getElementsByTagName( "sp" );
            $api['sp']['name'] = $xmlSp->item(0)->getAttribute("name");
            $api['sp']['servicename'] = $xmlSp->item(0)->getAttribute("servicename");
            $api['sp']['bypassapi'] = $xmlSp->item(0)->getAttribute("bypassapi");
            $api['sp']['providertype'] = $xmlSp->item(0)->getAttribute("providertype");
            $api['sp']['classname'] = $xmlSp->item(0)->getAttribute("classname");
            
            $xmlParam = $searchNode->getElementsByTagName( "param" );
            foreach( $xmlParam as $xmlParam )
            {
                $param['name'] =  $xmlParam->getAttribute("name");
                $param['param_type'] =  $xmlParam->getAttribute("param_type");
                $param['value'] =  $xmlParam->getAttribute("value");
                $param['type'] =  $xmlParam->getAttribute("type");
                $param['length'] =  $xmlParam->getAttribute("length");
                $param['key'] =  $xmlParam->getAttribute("key");
                $api['params'][] = $param;
            }
            $apis[$apiName] = $api;
        }
        return $apis;
    }

   

    public static function instance()
    {
        return new APIConfig();
    }

}