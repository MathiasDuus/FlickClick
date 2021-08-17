@extends('Layouts.app')

@section('content')
    <div class="row">
        <h1><b>Contact</b></h1>
    </div>
    <div class="row">
        <div class="col contact-form">
            <form method="POST" action="{{route('contact.update', $contact_site)}}"> @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <textarea class="form-control contact_editor" name="description" id="editor">{{$contact_site->description}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>

@endsection
