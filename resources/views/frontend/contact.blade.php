@extends("frontend.layouts.master")
@section("content")
			<!-- ============================ Who We Are Start ================================== -->
			<section>
				<div class="container">

					<div class="row">

						<div class="col-lg-5 col-md-5 bg-primary">
							<div class="contact-address light-text">
								<div class="add-box">
									<div class="add-icon-box">
										<i class="ti-home"></i>
									</div>
									<div class="add-text-box">
										<h4>Gia sư Ngọc Anh</h4>
										CEO: Ngọc Anh<br>
										CFO: Ngọc Anh<br>
									</div>
								</div>

								<div class="add-box">
									<div class="add-icon-box">
										<i class="ti-map-alt"></i>
									</div>
									<div class="add-text-box">
										<h4>Trụ sở</h4>
										Số 12 Triều Khúc,<br>
										Tân Triều, Thanh Trì, Hà Nội
									</div>
								</div>

								<div class="add-box">
									<div class="add-icon-box">
										<i class="ti-email"></i>
									</div>
									<div class="add-text-box">
										<h4>Emails</h4>
										nachinh2406@gmail.com<br>
										nachinh@giasuna.vn<br>
									</div>
								</div>
								<div class="add-box">
									<div class="add-icon-box">
										<i class="ti-headphone"></i>
									</div>
									<div class="add-text-box">
										<h4>Liên hệ</h4>
										+84 396820469<br>
										+84 975921890<br>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-7 col-md-7">
							<div class="contact-form">
								<form method="post" action="{{route("contact")}}">
                                    @csrf
									<div class="form-row">
										<div class="form-group col-md-6">
										  <label>Cá nhân / Doanh nghiệp</label>
										  <input type="text" name="name" required class="form-control">
										</div>
										<div class="form-group col-md-6">
										  <label>Email</label>
										  <input type="email" required name="email" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label>Chủ đề</label>
										<input type="text" required name="subject" class="form-control">
									</div>
									<div class="form-group">
										<label>Tin nhắn</label>
										<textarea required name="content" class="form-control"></textarea>
									</div>
									<button type="submit" class="btn btn-primary">Gửi yêu cầu</button>
								</form>
							</div>
						</div>

					</div>

				</div>
			</section>
			<div class="clearfix"></div>
			<!-- ============================ Who We Are End ================================== -->
@endsection
@push("js")

@endpush
