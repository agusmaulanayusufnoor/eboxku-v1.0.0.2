<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

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
        if ($this->isMethod('post')) {
            return $this->createRules();
        } elseif ($this->isMethod('put')) {
            return $this->updateRules();
        }
    }

    /**
     * Define validation rules to store method for resource creation
     *
     * @return array
     */
    public function createRules(): array
    {
        return [
            'type' => 'required|in:admin,user,pelayanan,kredit,akunting,umumpst,sekdir,skai,bisnis,sdm',
            'name' => 'required|string|max:191',
            'username' => 'required|string|max:191|unique:users',
            'password' => 'required|string|min:6'
        ];
    }

    /**
     * Define validation rules to update method for resource update
     *
     * @return array
     */
    public function updateRules(): array
    {
        return [
            'type' => 'sometimes|in:admin,user,pelayanan,kredit,akunting,sdm,sekdir,skai,umumpst,bisnis',
            'name' => 'sometimes|string|max:191',
            'username' => 'sometimes|string|max:191'
        ];
    }
}
