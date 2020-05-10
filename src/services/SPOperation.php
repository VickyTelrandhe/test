<?php 

namespace Finoux\DB\services;

use Illuminate\Support\Facades\DB;

class SPOperation{

    public function createSPQuery($spname,$params,$server = "mysql"){
        switch ($server) {
            case 'mysql':
                $spstring = "CALL ".$spname."(";
            //     $outquery = "Select ";
            //     $out = false;
            //     foreach ($params as $value) {
            //         if(strtolower($value['param_type']) == "out"){
            //             $spstring .= "@".$value['name'].",";
            //             $outquery .= "@".$value['name'].",";
            //             $out = true;
            //         }else{
            //             if($value['value'] == '0'){
            //                 $spstring .= "0,";
            //             }else if(empty($value['value']))
            //                 $spstring .= "NULL,";
            //             else 
            //                 $spstring .= "'".$value['value']."',";
            //         }
            //     }
            //     $spstring = trim($spstring,',').");";
                
            //     $outquery = trim($outquery,',');
            // //    echo $spstring;
            // //    exit();
            //     // DB::enableQueryLog();
            //     $result = DB::select($spstring);
            //     if($out)
            //         $out = DB::select($outquery);
            //     // dd($result,$out);
            //     return compact('result','out','spstring');

                /******************* multi resultset code *********************** */
                $syntax = '';
                foreach ($params as $key => $value) {
                // for ($i = 0; $i < count($params); $i++) {
                    if(strtolower($value['param_type']) == "out"){
                        $syntax .= (!empty($syntax) ? ',' : '') . "@".$value['name'];
                    }else{
                        $syntax .= (!empty($syntax) ? ',' : '') . '?';
                    }
                }
                $syntax = 'CALL ' . $spname . '(' . $syntax . ');';
               
                $pdo = DB::connection()->getPdo();
                $pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, true);
                $stmt = $pdo->prepare($syntax,[\PDO::ATTR_CURSOR=>\PDO::CURSOR_SCROLL]);
                $i = 1;
                $outquery = "Select ";
                $out = false;
                foreach ($params as $key => $value) {
                    if(strtolower($value['param_type']) == "out"){
                      
                        $spstring .= "@".$value['name'].",";
                        $outquery .= "@".$value['name'].",";
                        $out = true;
                    }else{
                        if($value['value'] == '0'){
                            $stmt->bindValue(( $i),"0");
                            $spstring .= "0,";
                        }else if(empty($value['value'])){
                            $stmt->bindValue(($i), NULL);
                            $spstring .= "NULL,";
                        }else{ 
                            $stmt->bindValue(( $i), $value['value']);
                            $spstring .= "'".$value['value']."',";
                        }
                        $i++;
                    }
                }
              
                $outquery = trim($outquery,',');
                $spstring = trim($spstring,',').");";
                // echo json_encode(['sp'=> $spstring] );
                // die;
                // print_r($stmt);
                // echo $spstring;die;
                // for ($i = 0; $i < count($params); $i++) {
                   
                //     $stmt->bindValue((1 + $i), $params[$i]);
                // }
                
                $exec = $stmt->execute();
                // $stmt->debugDumpParams();die;
                if (!$exec) return $pdo->errorInfo();
                // if ($isExecute) return $exec;
                
                $result = [];
                do {
                    try {
                        $result[] = $stmt->fetchAll(\PDO::FETCH_OBJ);
                    } catch (\Exception $ex) {

                    }
                } while ($stmt->nextRowset());

                if($out)
                $out = DB::select($outquery);

                if (1 === count($result))  $result = $result[0];
                // return $results;

                return compact('result','out','spstring');

                break;


                case 'post':

                    $syntax = '';
                    for ($i = 0; $i < count($params); $i++) {
                        $syntax .= (!empty($syntax) ? ',' : '') . '?';
                    }
                    $syntax = 'CALL ' . $spname . '(' . $syntax . ');';
                    $pdo = DB::connection()->getPdo();
                    $pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, true);
                    $stmt = $pdo->prepare($syntax,[\PDO::ATTR_CURSOR=>\PDO::CURSOR_SCROLL]);
                    $i = 0;
                    $outquery = "";
                    $out = false;
                    foreach ($params as $key => $value) {
                        if(strtolower($value['param_type']) == "out"){
                            $spstring .= "@".$value['name'].",";
                            $outquery .= "@".$value['name'].",";
                            $out = true;
                        }else{
                            if($value['value'] == '0'){
                                $stmt->bindValue((1 + $i),"0");
                            }else if(empty($value['value']))
                                $stmt->bindValue((1 + $i), NULL);
                            else 
                                $stmt->bindValue((1 + $i), $value['value']);
                                $i++;
                        }
                    }
                    $outquery = trim($outquery,',');
                    // for ($i = 0; $i < count($params); $i++) {
                       
                    //     $stmt->bindValue((1 + $i), $params[$i]);
                    // }
                    // $stmt->debugDumpParams();
                    $exec = $stmt->execute();
                    if (!$exec) return $pdo->errorInfo();
                    // if ($isExecute) return $exec;

                    $results = [];
                    do {
                        try {
                            $results[] = $stmt->fetchAll(\PDO::FETCH_OBJ);
                        } catch (\Exception $ex) {

                        }
                    } while ($stmt->nextRowset());

                    if($out)
                    $out = DB::select($outquery);

                    // if (1 === count($results)) return $results;
                    // return $results;

                    return compact('results','out');
                   



                    $spstring = "CALL ".$spname."(";
                    $outquery = "Select ";
                    $out = false;
                    foreach ($params as $value) {
                        if(strtolower($value['param_type']) == "out"){
                            $spstring .= "@".$value['name'].",";
                            $outquery .= "@".$value['name'].",";
                            $out = true;
                        }else{
                            if($value['value'] == '0'){
                                $spstring .= "0,";
                            }else if(empty($value['value']))
                                $spstring .= "NULL,";
                            else 
                                $spstring .= "'".$value['value']."',";
                        }
                    }
                    $spstring = trim($spstring,',').");";
                    
                    $outquery = trim($outquery,',');
                //    echo $spstring;
                //    exit();
                    // DB::enableQueryLog();
                    $result = DB::select($spstring);
                    if($out)
                        $out = DB::select($outquery);
                    // dd($result,$out);
                    return compact('result','out','spstring');
                    break;
        }

    }


    public static function instance()
    {
        return new SPOperation();
    }



}