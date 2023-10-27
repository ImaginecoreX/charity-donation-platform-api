<?php

namespace App\Http\Middleware;

class ValidatorManage {

    public $email;
    public $mobile;
    public $password;

    function __construct($email,$mobile,$password)
    {
        $this->email = $email;
        $this->mobile = $mobile;
        $this->password = $password; 
        
    }

    function validate():mixed{

        if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)){
            return  response()->json(['err' => "invalid email"], 422);
        }else if(strlen($this->email) >= 100){
            return  response()->json(['err' => "Email must have less than 100 characters"], 422);
        }else if(strlen($this->mobile) > 10){
            return  response()->json(['err' => "Mobile must have 10 characters"], 422);
        }else if(!preg_match("/07[0,1,2,3,4,5,6,7,8][0-9]/",$this->mobile)){
            return  response()->json(['err' => "Invalid Mobile"], 422);
        }else if(strlen($this->password) > 10 || strlen($this->password) < 5){
            return  response()->json(['err' => "Password must be between 5 - 10 charcters"], 422);
        }else{
           return "sucess";
        }

    }

}


?>
