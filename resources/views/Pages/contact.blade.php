@extends('Layouts.app')

@section('content')
    @auth
        @if(Auth::user()->access_level == 2)
            <div class="row card_padding">
                <div class="text-left">

                    <a href="{{ route('contact.edit', 1)}}" class="btn btn-primary"> Update description</a>
                </div>
            </div>
        @endif
    @endauth

    <div class="row card_padding">
        <h1><b>Contact</b></h1>
    </div>
    <div class="row">
        <p>{!! $contact_site !!}</p>
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
