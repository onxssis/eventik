<?php

namespace App\Http\Requests;

use App\Category;
use App\Event;
use Illuminate\Foundation\Http\FormRequest;
use MStaack\LaravelPostgis\Geometries\Point;

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
            'address' => 'required',
            // 'longitude' => 'required',
            // 'latitude' => 'required',
            'image' => 'required',
        ];
    }

    public function persist()
    {
        $event = Event::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price * 100,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'address' => $this->address,
            'location' => new Point($this->latitude, $this->longitude),
            'image' => $this->imagePath,
        ]);

        $categories = Category::find($this->categories);

        $event->categories()->attach($categories);

        session()->flash('success', 'Event created successfully.');

        return redirect()->to('/');
    }

    public function uploadEventImage()
    {
        $uploadedImage = $this->file('image');

        if ($uploadedImage) {
            app()->environment() === 'local' ?
                $this->imagePath = '/storage/' . $uploadedImage->store('covers', 'public') :
                $this->imagePath =  env('AWS_URL') . $uploadedImage->store('covers', 's3');
        } else {
            $this->imagePath = $this->image;
        }

        return $this;
    }
}
