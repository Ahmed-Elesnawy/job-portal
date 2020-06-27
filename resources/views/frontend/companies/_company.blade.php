<div class="col-lg-4 col-xl-3 col-md-6">
    <div class="single_company bg-white p-4 mt-4 text-center">
        <div class="thumb">
            <img class="img-fluid" src="{{ $company->imagePath }}" alt="">
        </div>
        <a href="{{ $company->companyShow }}">
            <h3>{{ $company->name }}</h3>
        </a>
        <p> <span>{{ $company->jobs_count }}</span> Available position</p>
    </div>
</div>