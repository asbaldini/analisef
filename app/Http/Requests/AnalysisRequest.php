<?php

namespace AnaliseF\Http\Requests;

use AnaliseF\Http\Requests\Request;

class AnalysisRequest extends Request
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
            'description' => 'required',
            'status' => 'sometimes|in:0,1',
            'actions' => 'required|array',
            'actions.*.name' => 'required|max:80',
            'actions.*.description' => 'required',
            'actions.*.equipment' => 'required|max:80',
            'actions.*.begin' => 'required|date_format:d/m/Y',
            'actions.*.deadline' => 'required|date_format:d/m/Y',
            'actions.*.engineers' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'Campo obrigatório!',
            'status.in' => 'Status inválido!',
            'actions.*.name.required' => 'Campo obrigatório',
            'actions.*.description.required' => 'Campo obrigatório',
            'actions.*.equipment.required' => 'Campo obrigatório',
            'actions.*.begin.required' => 'Campo obrigatório',
            'actions.*.deadline.required' => 'Campo obrigatório',
        ];
    }
}
