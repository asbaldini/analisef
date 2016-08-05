<?php

namespace AnaliseF\Http\Requests;

use AnaliseF\Http\Requests\Request;

class UserRequest extends Request
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
        return [
            'name' => 'required|max:80',
            'user' => 'required|max:40|unique:users,user,'.$this->request->get('id'),
            'password' => 'required_unless:_method,PUT|confirmed',
            'role' => 'sometimes|in:engineer,admin',
            'status' => 'sometimes|in:0,1'
        ];
    }
}
