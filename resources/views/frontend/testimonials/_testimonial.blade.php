 <div class="single_carousel">
 <div class="row">
    <div class="col-lg-11">
     <div class="single_testmonial d-flex align-items-center">
    <div class="thumb">
    <img src="{{ url('frontend') }}/img/testmonial/author.png" alt="">
    <div class="quote_icon">
    <i class="Flaticon flaticon-quote"></i>
    </div>
    </div>
<div class="info">
    <p>
        {{ $testimonial->say }}
    </p>
<span>- {{ $testimonial->name }}</span>
</div>
</div>
</div>
</div>
</div>