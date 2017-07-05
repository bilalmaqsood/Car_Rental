@extends('layouts.web-layout')

@section('content')
    <div class="slide_wrapper">
        <div class="top_location">
            <vehicles-search-form></vehicles-search-form>
        </div>
    </div>

    <top-vehicles-listing></top-vehicles-listing>

    <div class="about_section_wrapper" id="about_section_wrapper">
        <h2>About Qwik<span>k</span>ar</h2>
        <div class="about_content_section">
            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis convallis iactulis commodo. Nam augue lacus, tempor id metus sed, dignissim imperdiet nunc. Cras preEum
                tellus sit amet congue vehicula. Nunc commodo molesEe elit at consectetur. Fusce varius justo sed sagiHs consequat. Nulla eget lacus id odio Encidunt mollis gravida
                sagiHs enim. Duis preEum nulla augue, pulvinar placerat nulla consectetur ut. Nulla vitae purus ante. Praesent nec dui nunc. Suspendisse potenE.</p>
            <p>Nunc volutpat vehicula erat at facilisis. Quisque congue et turpis non maHs. Quisque egestas eleifend purus, eu finibus magna. In cursus fringilla leo consequat sollicitudin.
                Nunc in massa orci. Aenean pulvinar egestas rutrum. Aliquam elit libero, porta ac neque ut, fringilla laoreet lectus. Sed ut metus vitae risus iaculis vulputate. Curabitur
                preEum turpis nec velit commodo, nec egestas quam fringilla. Cras molesEe turpis eu lacus fringilla sodales. EEam a vesEbulum felis. Suspendisse laoreet dignissim nibh in
                posuere. Aenean a nisl dignissim, hendrerit magna vitae, interdum nisi. Suspendisse volutpat tortor vel libero dignissim, a viverra ex gravida.</p>
        </div>
    </div>

    <contact-us-form></contact-us-form>
@endsection
