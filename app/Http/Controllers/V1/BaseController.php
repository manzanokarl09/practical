<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    //

    protected function exceptionHandler($callback){
        try {

            return $callback();

        } catch (\Exception $ex) {

            return clientErrorResponse([], [
                "message" => $ex->getMessage(),
                "line"    => $ex->getLine(),
            ]);

        }

    }

    protected function registrationExceptionHandler($callback){
        try {
            return $callback();

        } catch (\Exception $ex) {

            return response()->json(['message' => 'Email already taken.'], 400);

        }

    }
}
