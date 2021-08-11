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
            <form method="POST">
                <div class="form-group">
                    <input required maxlength="100" name="Name" type="text" class="form-control" id="inputName" placeholder="Your Name...">
                </div>
                <div class="form-group">
                    <input required maxlength="150" name="Email" type="email" class="form-control" id="inputEmail" placeholder="Your Email Address...">
                </div>
                <div class="form-group">
                    <textarea required name="Message" maxlength="1000" class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder="Your Message..."></textarea>
                </div>
                <button type="submit" name="contact" class="btn btn-secondary">Send</button>
            </form>
        </div>
    </div>

@endsection
