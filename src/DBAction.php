<?php

namespace Finoux\DB;

use Finoux\DB\traits\ValidationTrait;
use Finoux\DB\services\BaseService;
use Finoux\DB\services\APIConfig;
use Finoux\DB\model\SPModel;

class DBAction extends BaseService
{
    use ValidationTrait;
    public function callSP($params,$spname)
    {
        try {
            $this->do_arrvalidate(['methodname'=>$spname],['methodname'=>"required"]);
           
            if($this->validator->fails()){ 
                return $this->sendError(config('api_status_code.RES_FAILED.MESSAGE'),$this->validator->errors()->all() ,config('api_status_code.RES_FAILED.CODE'));
            }

            $arr =  APIConfig::instance()->getAPIConfig();
            
            if(!isset($arr[$spname])){
                return $this->sendError(config('api_status_code.RES_INVALID_PARAMETER.MESSAGE'),$this->validator->errors()->all() ,config('api_status_code.RES_INVALID_PARAMETER.CODE'));
            }
            
            $result = SPModel::callSP($arr[$spname],$params);
            return $this->sendResponse($result,"success");
        } catch (\Exception $th) {
            return $this->sendError($th->getMessage());
         }
    }
}