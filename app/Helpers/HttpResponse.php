<?php

function showResponse($data) {


    $response = [
        'code'   => 200,
        'status' => true,
        'data'   => $data,
    ];

    return response()->json($response, $response['code']);
}


function listResponse($data) {
    $response = [
        'code'   => 200,
        'status' => true,
        'data'   => $data,
    ];

    return response()->json($response, $response['code']);
}

function createdResponse($data) {


    $response = [
        'code'   => 201,
        'status' => true,
        'data'   => $data,
    ];

    return response()->json($response, $response['code']);
}

function notFoundResponse() {


    $response = [
        'code'    => 404,
        'status'  => false,
        'data'    => 'Resource Not Found',
        'message' => 'Not Found',
    ];

    return response()->json($response, $response['code']);
}


function deletedResponse() {


    $response = [
        'code'    => 204,
        'status'  => true,
        'data'    => [],
        'message' => 'Resource deleted',
    ];

    return response()->json($response, $response['code']);
}


function clientErrorResponse(array $validation = [],array $exception = []) {


    $response = [
        'code'    => 422,
        'status'  => false,
        'data'    => [
            "validation" => $validation,
            "exception" => $exception
        ],
        'message' => 'Unprocessable entity',
    ];

    return response()->json($response, $response['code']);
}

function unauthorizedResponse() {


    $response = [
        'code'    => 401,
        'status'  => false,
        'data'    => [],
        'message' => 'Unauthorized',
    ];

    return response($response, 401);
}


function customResponse($response) {
    $data = [
        'message' => $response['message']
    ];
    return response($data, $response['code']);
}

function customResponseLogin($response) {
    $data = [
        'access_token' => $response['access_token']
    ];
    return response($data, $response['code']);
}