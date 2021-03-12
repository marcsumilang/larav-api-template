<?php

namespace Api\V1_0_0\Http\Requests;

use Api\Exceptions\CustomException;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool|\App\Exceptions\CustomException
     */
    public function authorize()
    {

        if($this->segment(3) == $this->user()->id){
            return true;
        }

        throw new CustomException(403, "This action is unautorized.");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        switch($this->method()){
            case "POST":
                return [
                    "name" => "required",
                    "email" => "required|email|unique:users,email",
                ];
            break;

            case "PUT":
                return [
                    "name" => "required",
                    "email" => "required|email|unique:users,email,".$this->user()->id,
                ];
            break;

            default;
                return [
                    //
                ];
            break;
        }

    }
}
