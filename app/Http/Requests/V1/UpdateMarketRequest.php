<?php

declare(strict_types=1);

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMarketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /*$user = $this->user();

        if (!$user) {
            return true;
        }

        return $user->tokenCan('assignSector');*/
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $method = $this->method();

        foreach ($this->json() as $key => $parameter) {
            $this->mergeIfMissing([$key => $parameter]);
        }

        if ($method == 'PUT') {
            if ($this->all('name') && $this->all('address')) {
                return [];
            }

            return [
                'name' => ['required'],
                'address' => ['required'],
            ];
        } else {
            return [
                'name' => ['sometimes', 'required'],
                'address' => ['sometimes', 'required'],
            ];
        }
    }
}
