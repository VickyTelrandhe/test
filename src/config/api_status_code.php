<?php

return [
    'RES_OK' => [
        'CODE' => 201,
        'MESSAGE' => 'Success',
    ],
    'RES_AUTH_FAILED' => [
        'CODE' => 202,
        'MESSAGE' => 'Authentication failure',
    ],
    'RES_FAILED' => [
        'CODE' => 203,
        'MESSAGE' => 'Validation failure',
    ],
    'RES_INVALID_PARAMETER' => [
        'CODE' => 204,
        'MESSAGE' => 'Invalid Parameters',
    ],
    'RES_DATA_NOT_FOUND' => [
        'CODE' => 404,
        'MESSAGE' => 'Data not found',
    ],
    'RES_BAD_REQUEST' => [
        'CODE' => 400,
        'MESSAGE' => 'The request could not be understood by the server due to malformed syntax',
    ],
    'RES_BAD_PARAMETER' => [
        'CODE' => 422,
        'MESSAGE' => 'Expected json, received unprocessable or null data',
    ],
    'RES_TOKEN_EXPIRED' => [
        'CODE' => 206,
        'MESSAGE' => 'Token expired!',
    ],
    'RES_SERVER_ERROR' => [
        'CODE' => 500,
        'MESSAGE' => 'Oops we encountered an internal server error',
    ],
    'RES_UNAUTHORIZED' => [
        'CODE' => 401,
        'MESSAGE' => 'Unauthorized',
    ],
    'RES_UNACCEPTABLE' => [
        'CODE' => 406,
        'MESSAGE' => 'Not Acceptable',
    ],

];
