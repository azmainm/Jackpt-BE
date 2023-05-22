<?php

namespace App\Constants;

use App\Helpers\ConstGetter;

class ResponseMessages
{
    use ConstGetter;

    const SUCCESS = 'Successful';

    const BAD_REQUEST = 'Bad request';

    const UNAUTHORIZED = 'Unauthorized';

    const FORBIDDEN = 'Forbidden';

    const NOT_FOUND = 'Not found';

    const CONFLICT = 'Conflict';

    const NOT_ALLOWED = 'Not Allowed';

    const MISDIRECTED = 'Misdirected';

    const UNPROCESSABLE_ENTRY = 'Unprocessable Entity';

    const INTERNAL_SERVER_ERROR = 'Internal Server Error';
}
