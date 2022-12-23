<?php

declare(strict_types=1);

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSectorRequest extends FormRequest
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

        return $user->tokenCan('assignRoom');*/
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
            if ($this->all('code')) {
                return [];
            }

            return [
                'code' => ['required'],
            ];
        } else {
            return [
                'code' => ['sometimes', 'required'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->marketId) {
            $this->merge([
                'market_id' => $this->marketId,
            ]);
        }
    }
}
