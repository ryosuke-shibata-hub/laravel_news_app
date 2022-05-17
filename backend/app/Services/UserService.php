<?php

namespace App\SerVices;

use Auth;

class UserService
{

  public function loginUserId() {

    if (Auth::check()) {
            $user = Auth::user();
            $user_id = $user->id;
        } else {
            $user_id = null;
        }
      return $user_id;
  }

}
