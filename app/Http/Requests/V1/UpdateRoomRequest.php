<?php

declare(strict_types=1);

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateRoomRequest extends FormRequest
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

        return $user->tokenCan('update');*/
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
            if ($this->all('number') && $this->all('space')) {
                return [];
            }

            return [
                'number' => ['required'],
                'space' => ['required'],
            ];
        } else {
            return [
                'number' => ['sometimes', 'required'],
                'space' => ['sometimes', 'required'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->bookedFrom) {
            $this->merge([
                'booked_from' => $this->bookedFrom,
            ]);
        }

        if ($this->bookedTo) {
            $this->merge([
                'booked_to' => $this->bookedTo,
            ]);
        }

        if ($this->sectorId) {
            $this->merge([
                'sector_id' => $this->sectorId,
            ]);
        }
    }
}
