<section class="contact-area section-padding-100-0">
    <div class="container">
        <div class="row">

            <!-- Contact Information -->
            <div class="col-12 col-lg-6">
                <div class="contact-information mb-100">

                    <!-- Contact Logo -->
                    <div class="contact-logo mb-50">
                       <img src="{{ asset('frontend/img/trading.jpg') }}" alt="">
                    </div>

                    <p>การลงทุนมีความเสี่ยง แต่คุณทราบหรือไม่ว่า การไม่ลงทุนมีความเสี่ยงมากกว่า
                        มาเรียนรู้เรื่องลงทุนง่ายๆ แบบ Step by Step ได้ที่นี่</p>
                </div>
            </div>

            <!-- Contact Form Area -->
            <div class="col-12 col-lg-6">
                <div class="contact-form-area mb-100">
                    <form action="{{ route('send') }}" method="post">
                        @csrf
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                        <input type="email" class="form-control" id="email" placeholder="E-mail" name="email">
                        <textarea name="message" class="form-control" id="message" cols="30" rows="10"
                                  placeholder="Message"></textarea>
                        <button class="btn cryptos-btn btn-2 mt-30" type="submit">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>