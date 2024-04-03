@extends('layouts.clients')
<link rel="stylesheet" href="{{ asset('assets/css/clients/contact.css') }}">
@section('content')
<div class="container-fluid" id="container-fluid">
    <div class="container-fluid bg-1 p-5" id="bg">
        <h1 class="text-center">Contact Us</h1>
        <p class="text-center">We consider all the drivers of change gives you the components you need to change to create a truly happens.</p>
    </div>
    <div class="container-fluid bg-white p-5" id="bg">
    </div>
    <div class="container">
        <form action="" method="post">
            @csrf
            <div class="row d-flex justify-content-between">
                <div class="col-md-6" style="padding: 0;width:48%" >
                    <label for="name" class="form-label custom-label" style="margin-left: 12px;">Name</label>
                    <input type="text" class="form-control rounded-pill" name="name" id="name" placeholder="Enter your name">
                </div>
                <div class="col-md-6" style="padding: 0;width:48%" >
                    <label for="email" class="form-label custom-label" style="margin-left: 12px;">Email</label>
                    <input type="email" class="form-control rounded-pill" name="email" id="email" placeholder="Enter your email">
                </div>
            </div>
            <div class="row">
                <label for="subject" class="col-form-label custom-label">Subject</label>
                <input type="text" class="form-control rounded-pill" id="subject" name="subject" placeholder="Enter the subject">
            </div>
            <div class="row">
                <label for="message" class="col-form-label custom-label">Message</label>
                <textarea class="form-control" id="message" rows="5" name="message" placeholder="Enter your message"></textarea>
            </div>
            <div class="row"></div>
            <div class="row">
                <button type="submit" class="btn btn-primary" style="background-color: #AD343E; border: 1px solid black; border-radius: 118px;">Send</button>
            </div>
        </form>
    </div>
    <div class="container" id="contact-us" >
        <div class='container'>
            <label class='form-label custom-label css-label'>Call Us:</label>
            <p class='custom-class'>+1-234-567-8900</p>
        </div>
        <div class='container'>
            <label class='form-label custom-label css-label'>Hours:</label>
            <p class='hour-location'>Mon-Fri: 11am - 8pm</p>
            <p class='hour-location'>Sat, Sun: 9am - 10pm</p>
        </div>
        <div class='container'>
            <label class='form-label custom-label css-label'>Our Location:</label>
            <p class='hour-location'>123 Bridge Street</p>
            <p class='hour-location'>Nowhere Land, LA</p>
            <pclass='hour-location'>USA</p>
        </div>
    </div>
</div>

@if(isset($successMessage))
    <script>
        alert("{{ $successMessage }}");
    </script>
@endif

@endsection