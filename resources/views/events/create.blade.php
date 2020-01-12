@extends('layouts.master')

@section('content')
<section>
    <div class="container">
        <div class="columns is-centered m-t-lg m-b-lg">

            <div class="column is-8">

                <div class="box">

                    <div class="header m-b-lg has-text-centered">
                        <p class="title is-3">Create an Event</p>
                    </div>

                    <form action="{{ route('events.store') }}" method="POST" class="content"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="field">
                            <label class="label">Title</label>

                            <div class="control">
                                <input class="input{{ $errors->has('title') ? ' is-danger' : '' }}" type="text"
                                    name="title" placeholder="Event title" required>
                            </div>

                            @if ($errors->has('title'))
                            <p class="help is-danger">
                                {{ $errors->first('title') }}
                            </p>
                            @endif

                        </div>

                        <div class="field">
                            <label class="label">Location</label>

                            <div class="control">
                                <input class="input{{ $errors->has('location') ? ' is-danger' : '' }}" type="text"
                                    name="location" placeholder="Event location" id="location-autocomplete" required>

                                <input type="hidden" name="longitude" id="lng-autocomplete" value="">
                                <input type="hidden" name="latitude" id="lat-autocomplete" value="">
                            </div>

                            @if ($errors->has('location'))
                            <p class="help is-danger">
                                {{ $errors->first('location') }}
                            </p>
                            @endif
                        </div>

                        <div class="field">
                            <label class="label">Description</label>

                            <div class="control">
                                <textarea class="textarea{{ $errors->has('description') ? ' is-danger' : '' }}"
                                    name="description" placeholder="Event description" name="decription"
                                    required></textarea>
                            </div>

                            @if ($errors->has('description'))
                            <p class="help is-danger">
                                {{ $errors->first('description') }}
                            </p>
                            @endif
                        </div>

                        <div class="field">
                            <label class="label">Start date and Time</label>

                            <div class="control">
                                <datetime input-class="input{{ $errors->has('start_date') ? ' is-danger' : '' }}"
                                    class="theme-orange" placeholder="Select Date and Time" id="start_date" required
                                    use12-hour :min-datetime="(new Date).toISOString()" :week-start="7"
                                    name="start_date" format="yyyy-MM-dd HH:mm:ss" type="datetime">
                                </datetime>
                            </div>

                            @if ($errors->has('start_date'))
                            <p class="help is-danger">
                                {{ $errors->first('start_date') }}
                            </p>
                            @endif
                        </div>

                        <div class="field">
                            <label class="label">End date and Time</label>

                            <div class="control">
                                <datetime input-class="input{{ $errors->has('end_date') ? ' is-danger' : '' }}"
                                    class="theme-orange" placeholder="Select Date and Time" id="end_date" use12-hour
                                    :min-datetime="(new Date).toISOString()" name="end_date" :week-start="7"
                                    format="yyyy-MM-dd HH:mm:ss" required type="datetime">
                                </datetime>
                            </div>

                            @if ($errors->has('end_date'))
                            <p class="help is-danger">
                                {{ $errors->first('end_date') }}
                            </p>
                            @endif
                        </div>

                        <div class="field">
                            <label class="label">Price</label>

                            <div class="control">
                                <input type="number" class="input{{ $errors->has('price') ? ' is-danger' : '' }}"
                                    name="price" value="0">
                            </div>

                            @if ($errors->has('price'))
                            <p class="help is-danger">
                                {{ $errors->first('price') }}
                            </p>
                            @endif
                        </div>

                        <div class="field">
                            <label class="label">Cover Image</label>

                            <div class="file has-name is-fullwidth">
                                <label class="file-label">
                                    <input class="file-input{{ $errors->has('image') ? ' is-danger' : '' }}" type="file"
                                        name="image" id="event-file">
                                    <span class="file-cta">
                                        <span class="file-icon">
                                            <i class="fas fa-upload"></i>
                                        </span>
                                        <span class="file-label">
                                            Choose a file…
                                        </span>
                                    </span>
                                    <span class="file-name">

                                    </span>
                                </label>

                                @if ($errors->has('image'))
                                <p class="help is-danger">
                                    {{ $errors->first('image') }}
                                </p>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Categories</label>

                            <div class="control">
                                <div
                                    class="select is-fullwidth is-multiple{{ $errors->has('categories') ? ' is-danger' : '' }}">
                                    <select name="categories[]" multiple id="category-opt" required>
                                        {{-- <option>Select category</option> --}}

                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ ucfirst($category->name) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            @if ($errors->has('categories'))
                            <p class="help is-danger">
                                {{ $errors->first('categories') }}
                            </p>
                            @endif
                        </div>

                        <div class="field m-t-lg">
                            <div class="control">
                                <button type="submit" class="button is-danger is-fullwidth">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection

@section('footer-scripts')
<script src="{{ asset('js/autocomplete.js') }}"></script>

<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API') }}&libraries=places&callback=initAutocomplete"
    async defer></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
    $('#category-opt').select2();
</script>
@endsection

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection