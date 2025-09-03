<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UpdateVenueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //TEMPORARY
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'google_maps_link' => 'nullable|string',
            'municipality_id' => 'required|exists:municipalities,id',
            'type_id' => 'required|exists:venue_types,id',
            'venue_opening_hours' => 'nullable|array', 
            'venue_opening_hours.*.day_of_week' => 'nullable|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'venue_opening_hours.*.open_time' => 'nullable|date_format:H:i',
            'venue_opening_hours.*.close_time' => 'nullable|date_format:H:i',
            'venue_opening_hours.*.notes' => 'nullable|string',
        ];
    }
}
