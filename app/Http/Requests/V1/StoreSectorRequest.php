<?php

declare(strict_types=1);

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectorRequest extends FormRequest
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
        return [
            'code' => ['required'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'market_id' => $this->marketId,
        ]);
    }
}
