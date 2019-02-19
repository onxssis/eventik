<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Event;
use App\Category;

class StoreEvent extends FormRequest
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
            'categories' => 'required|array',
            'price' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'location' => 'required',
        ];
    }

    public function persist()
    {
        $event = Event::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'address' => $this->location,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'image' => $this->imagePath,
        ]);

        $categories = Category::find($this->categories);

        $event->categories()->attach($categories);

        session()->flash('success', 'Event created successfully.');

        return $event;
    }

    public function uploadEventImage()
    {
        $uploadedImage = $this->file('image');

        if ($uploadedImage) {
            $this->imagePath = $uploadedImage->store('covers', 'public');
        } else {
            $this->imagePath = $this->image;
        }

        return $this;
    }
}
