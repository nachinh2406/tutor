<div class="hero-header jumbo-banner text-center" style="background: url({{asset("frontend/assets/img/bn-1.jpg")}});" data-overlay="8">
    <div class="container">
        <h1>100 lớp mới trong tháng này</h1>
        <p class="lead">Tìm lớp mới, phù hợp tại đây</p>
        <form class="search-big-form no-border search-shadow" action="{{route("classes")}}" method="get">
            <div class="row m-0">
                <div class="col-lg-10 col-md-10 col-sm-12 p-0">
                    <div class="form-group">
                        <i class="ti-search"></i>
                        <input type="text" name="search" class="form-control b-r" placeholder="Tìm kiếm lớp tại đây">
                    </div>
                </div>
                {{-- <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                    <div class="form-group">
                        <i class="ti-location-pin"></i>
                        <input type="text" class="form-control b-r" placeholder="Location">
                    </div>
                </div> --}}

                {{-- <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                    <div class="form-group">
                        <select id="category" class="js-states form-control">
                            <option value="">&nbsp;</option>
                            <option value="1">SEO & Web Design</option>
                            <option value="2">Wealth & Healthcare</option>
                            <option value="3">Account / Finance</option>
                            <option value="4">Education</option>
                            <option value="5">Banking Jobs</option>
                        </select>
                    </div>
                </div> --}}

                <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                    <button type="submit" class="btn btn-primary full-width">Tìm kiếm</button>
                </div>
            </div>
        </form>
    </div>
</div>
