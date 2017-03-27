<?php

namespace App\Http\Requests;

use App\Models\Monitor;
use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;

class SessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(!$this->user())
            return false;

        if($this->route("session")) {
            if($this->route("session")->status >= 4)
                return false;
            if($this->route("session")->status > 1) {
                if ($this->user()->role instanceof Monitor && $this->user()->role->id != $this->route("session")->monitor_id)
                    return false;
                if ($this->user()->role instanceof Student && $this->user()->role->id != $this->route("session")->student_id)
                    return false;
            }
            return true;
        }
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
            'sessionDate' => 'required|date|after:now',
            'begin' => 'required|date_format:"H:i"',
            'end' => 'required|date_format:"H:i"',
            'departure' => [
                'required',
                'regex:/^((-|)\d*\.\d*),((-|)\d*\.\d*)$/'
            ],
            'arrival' => [
                'required',
                'regex:/^((-|)\d*\.\d*),((-|)\d*\.\d*)$/'
            ]
        ];

        if($this->route("session")) {
            switch($this->route("session")->status) {
                case 0 :
                    $rules = [
                        "session_id" => "required|integer", //Session of the matching to delete
                    ];
                    break;
                case 1 :
                    $rules = [
                        "cancel" => "boolean" //If the matchning is not validated
                    ];
                    break;
                case 2 :
                    $rules = [
                        'departure' => [
                            'required',
                            'regex:/^((-|)\d*\.\d*),((-|)\d*\.\d*)$/'
                        ]
                    ];
                    break;
                case 3 :
                    $rules = [
                        'description' => 'required|string',
                        'rate' => 'required|integer|between:0,5',
                        'distance' => 'required|integer',
                        'arrival' => [
                            'required',
                            'regex:/^((-|)\d*\.\d*),((-|)\d*\.\d*)$/'
                        ]
                    ];
                    break;
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
