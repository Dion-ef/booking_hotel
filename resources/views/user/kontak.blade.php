@extends('layout.user')

@section('konten')
<section class="site-hero inner-page overlay" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row site-hero-inner justify-content-center align-items-center">
                <div class="col-md-10 text-center" data-aos="fade">
                    <h1 class="heading mb-3">Kontak</h1>
                    <ul class="custom-breadcrumbs mb-4">
                        <li><a href="/index">Home</a></li>
                        <li>&bullet;</li>
                        <li>Kontak</li>
                    </ul>
                </div>
            </div>
        </div>

        <a class="mouse smoothscroll" href="#next">
            <div class="mouse-icon">
                <span class="mouse-wheel"></span>
            </div>
        </a>
    </section>
    <!-- END section -->

    @guest
    <section class="section contact-section" id="next">
        <div class="container">
            <div class="row">
                <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">

                    <form action="/pesan/guest" method="post" class="bg-white p-md-5 p-4 mb-5 border">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control " name="nama">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="phone">Phone</label>
                                <input type="text" id="phone" class="form-control " name="phone">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" class="form-control " name="email">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12 form-group">
                                <label for="message">Pesan</label>
                                <textarea name="pesan" id="message" class="form-control " cols="30" rows="8"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="submit" value="Send Message" class="btn btn-primary text-white font-weight-bold">
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-md-5" data-aos="fade-up" data-aos-delay="200">
                    <div class="row">
                        <div class="col-md-10 ml-auto contact-info">
                            @foreach($asset as $item)
                            <p><span class="d-block">Address:</span> <span> {{$item->alamat}} </span></p>
                            <p><span class="d-block">Phone:</span> <span> {{$item->phone}}</span></p>
                            <p><span class="d-block">Email:</span> <span> {{$item->email}}</span></p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endguest

    @auth
    <section class="section contact-section" id="next">
        <div class="container">
            <div class="row">
                <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">

                    <form action="/pesan" method="post" class="bg-white p-md-5 p-4 mb-5 border">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control " name="nama">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="phone">Phone</label>
                                <input type="text" id="phone" class="form-control " name="phone">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" class="form-control " name="email">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12 form-group">
                                <label for="message">Pesan</label>
                                <textarea name="pesan" id="message" class="form-control " cols="30" rows="8"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="submit" value="Send Message" class="btn btn-primary text-white font-weight-bold">
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-md-5" data-aos="fade-up" data-aos-delay="200">
                    <div class="row">
                        <div class="col-md-10 ml-auto contact-info">
                            @foreach($asset as $item)
                            <p><span class="d-block">Address:</span> <span> {{$item->alamat}} </span></p>
                            <p><span class="d-block">Phone:</span> <span> {{$item->phone}}</span></p>
                            <p><span class="d-block">Email:</span> <span> {{$item->email}}</span></p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endauth




    <!-- <section class="section testimonial-section">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-md-7">
                    <h2 class="heading" data-aos="fade-up">People Says</h2>
                </div>
            </div>
            <div class="row">
                <div class="js-carousel-2 owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">

                    <div class="testimonial text-center slider-item">
                        <div class="author-image mb-3">
                            <img src="images/person_1.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
                        </div>
                        <blockquote>

                            <p>&ldquo;A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.&rdquo;</p>
                        </blockquote>
                        <p><em>&mdash; Jean Smith</em></p>
                    </div>

                    <div class="testimonial text-center slider-item">
                        <div class="author-image mb-3">
                            <img src="images/person_2.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
                        </div>
                        <blockquote>
                            <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.&rdquo;</p>
                        </blockquote>
                        <p><em>&mdash; John Doe</em></p>
                    </div>

                    <div class="testimonial text-center slider-item">
                        <div class="author-image mb-3">
                            <img src="images/person_3.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
                        </div>
                        <blockquote>

                            <p>&ldquo;When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane.&rdquo;</p>
                        </blockquote>
                        <p><em>&mdash; John Doe</em></p>
                    </div>


                    <div class="testimonial text-center slider-item">
                        <div class="author-image mb-3">
                            <img src="images/person_1.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
                        </div>
                        <blockquote>

                            <p>&ldquo;A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.&rdquo;</p>
                        </blockquote>
                        <p><em>&mdash; Jean Smith</em></p>
                    </div>

                    <div class="testimonial text-center slider-item">
                        <div class="author-image mb-3">
                            <img src="images/person_2.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
                        </div>
                        <blockquote>
                            <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.&rdquo;</p>
                        </blockquote>
                        <p><em>&mdash; John Doe</em></p>
                    </div>

                    <div class="testimonial text-center slider-item">
                        <div class="author-image mb-3">
                            <img src="images/person_3.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
                        </div>
                        <blockquote>

                            <p>&ldquo;When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane.&rdquo;</p>
                        </blockquote>
                        <p><em>&mdash; John Doe</em></p>
                    </div>

                </div>
            </div>

        </div>
    </section> -->
@endSection