<?php

namespace App\Http\Middleware;

class FormValidator
{

  public $email;
  public $msg;

  function __construct($email, $msg)
  {
    $this->email = $email;
    $this->msg = $msg;
  }

  function validate(): mixed
  {

    if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
      return response()->json(['err' => "invalid email"], 422);
    } else if (strlen($this->email) >= 100) {
      return response()->json(['err' => "Email must have less than 100 characters"], 422);
    } else if (strlen($this->msg) >= 3000) {
      return response()->json(['err' => "Message must be less that 3000 characters"], 422);
    }else{
      return "success";
    }

  }

}