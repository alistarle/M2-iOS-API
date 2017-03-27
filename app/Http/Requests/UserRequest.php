<?php

namespace App\Http\Requests;

use App\Models\Monitor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules = [
            "name" => "required|string",
            "email" => "required|email|unique:users",
            "password" => "required|string|min:6",
            "password_confirmation" => "required|same:password",
            "avatar" => "image",
            "phone" => "required|digits:10",
            "address" => "required|string",
            "cp" => "required|digits:5",
            "city" => "required|string",
            "range_km" => "required|integer",
            "price" => "required|integer",
            "role" => [
                "required",
                Rule::in(['monitor', 'student'])
            ]
        ];

        //If it is an edition
        if(request()->user()) {
            $rules["email"] = [ "required", "email", Rule::unique('users')->ignore(request()->user()->id) ];
            $rules["password"] = "string|min:6";
            $rules["password_confirmation"] = "same:password";
            $rules["role"] = "";

            if(request()->user()->role instanceof Monitor) {
                $rules["vehiculeBrand"] = "required_with:vehiculeModel,vehiculeYear|string";
                $rules["vehiculeModel"] = "required_with:vehiculeBrand,vehiculeYear|string";
                $rules["vehiculeYear"] = "required_with:vehiculeBrand,vehiculeModel|digits:4";
            }
        }

        return $rules;
    }

    public function ajax()
    {
        /* 1. Call the builtin method */
        if ($this->isXmlHttpRequest())
        {
            return true;
        }

        /* 2. Then check the Content-Type */
        $content_type = $this->header('Content-Type');
        $allowable_types = array(
            'application/json',
            'application/javascript',
        );
        if (in_array(
            strtolower($content_type),
            $allowable_types))
        {
            return true;
        }

        /* 3. Otherwise, not Ajax */
        return false;
    }
}
