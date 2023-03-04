<?php

namespace App\Http\Validates;

use App\Common\Constants\ErrorCode;
use App\Common\Response\RespResult;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ValidRequest extends FormRequest
{
    /**
     * @desc 自定义验证规则
     * @param Validator $validator
     * @return void
     */
    public function failedValidation(Validator $validator)
    {
        $error = $validator->errors()->first();
        throw new HttpResponseException(RespResult::error(ErrorCode::VALID_FAIL, $error));
    }
}
