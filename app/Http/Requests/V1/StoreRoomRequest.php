<?php

declare(strict_types=1);

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
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

        return $user->tokenCan('create');*/
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
            'number' => ['required'],
            'space' => ['required'],
        ];
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
