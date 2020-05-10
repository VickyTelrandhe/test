<?php

namespace Finoux\DB\model;

use Finoux\DB\exceptions\DBException;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Finoux\DB\services\SPOperation;

class SPModel extends Model
{
    public static function callSP($apiDetails,$params, $type = ''){

        try{
            $spparams = [];
            if(isset($apiDetails['params'])){
                foreach ($apiDetails['params'] as $key => $value) {
                    $key = $value['key'];
                    $value['value'] = isset($params[$key]) ? $params[$key] : $value['value'];
                    $spparams[] = $value;
                }
            }
            // print_r($spparams);
            $resultset  =  SPOperation::instance()->createSPQuery($apiDetails['sp']['name'],$spparams,config("database.default"));
            
            // dd($resultset);
            //    $queries = DB::getQueryLog();
            // dd($queries);
            return $resultset;
        }catch(Exception $e){
            throw new DBException($e->getMessage());
        }
    }

    public static function testSP($apiDetails,$params, $type = ''){

        try{
            $spparams = [];
            if(isset($apiDetails['params'])){
                foreach ($apiDetails['params'] as $key => $value) {
                    $key = $value['key'];
                    $value['value'] = isset($params[$key]) ? $params[$key] : $value['value'];
                    $spparams[] = $value;
                }
            }

            $resultset  =  SPOperation::instance()->createSPQuery($apiDetails['sp']['name'],$spparams,"post");
            
            // dd($resultset);
            //    $queries = DB::getQueryLog();
            // dd($queries);
            return $resultset;
        }catch(Exception $e){
            throw new DBException($e->getMessage());
        }
    }



}
