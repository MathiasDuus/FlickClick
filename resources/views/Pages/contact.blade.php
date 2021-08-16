@extends('Layouts.app')

@section('content')

    <div class="row">
        <h1><b>Contact</b></h1>
    </div>
    <div class="row">
        <p>{{$contact_site}}</p>
    </div>

    <div class="row">
        <div class="col contact-form">
            <h2 class="red-text"><b>Get in touch</b></h2>
            <form method="POST" action="{{route('contact.store')}}"> @csrf
                <div class="form-group">
                    <input name="name" type="text" class="form-control" id="inputName" placeholder="Your Name...">
                </div>
                <div class="form-group">
                    <input name="email" type="email" class="form-control" id="inputEmail" placeholder="Your Email Address...">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="message" rows="5" placeholder="Your Message..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>

@endsection
