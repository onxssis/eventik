<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEvent extends FormRequest
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
            'title' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'address' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ];
    }

    public function updateEvent($event)
    {
        if ($this->hasFile('image')) {
            $event->image = $this->file('image')->store('covers', 'public');
        }

        $event->title = $this->title;
        $event->description = $this->description;
        $event->category_id = $this->category_id;
        $event->price = $this->price;
        $event->start_date = $this->start_date;
        $event->end_date = $this->end_date;
        $event->address = $this->address;
        $event->longitude = $this->longitude;
        $event->latitude = $this->latitude;

        $event->save();

        return $event;
    }
}
