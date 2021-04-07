<?php
namespace App\Http\Controllers\API;

    trait ApiResourceTrait{



        public function apiResponse($data=null,$error=null,$code=200,$msg=null,$count=0){
            $array=[
            
                'data'=>$data,
                "itemsCount"=>$count,
                'success'=>$data==null ? false:true,
                'statusCode' =>$code,
                'message' =>$msg,
            ];
            return response($array);
        }

    }


?>
