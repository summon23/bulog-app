<?php $assetpath = base_url()."themes/metronic/";?>
					<div class="m-content">

						<!--begin:: Widgets/Stats-->
						<div class="m-portlet  m-portlet--unair">
							<div class="m-portlet__body  m-portlet__body--no-padding">
								<div class="row m-row--no-padding m-row--col-separator-xl">
									<div class="col-md-12 col-lg-6 col-xl-3">

										<!--begin::Total Profit-->
										<div class="m-widget24">
											<div class="m-widget24__item">
												<h4 class="m-widget24__title">
													Total SPK
												</h4><br>
												<span class="m-widget24__stats m--font-brand">
													<?php echo $totalpenerimaan->total;?>
												</span>
												<div class="m--space-10"></div>
												<br><br>
											</div>
										</div>

										<!--end::Total Profit-->
									</div>
									<div class="col-md-12 col-lg-6 col-xl-3">

										<!--begin::New Feedbacks-->
										<div class="m-widget24">
											<div class="m-widget24__item">
												<h4 class="m-widget24__title">
													Total Penerimaan
												</h4><br>
												<span class="m-widget24__stats m--font-info">
													<?php echo $totalpenerimaan->total;?>
												</span>	
												<div class="m--space-10"></div>	
												<br><br>								
											</div>
										</div>

										<!--end::New Feedbacks-->
									</div>
									<div class="col-md-12 col-lg-6 col-xl-3">

										<!--begin::New Orders-->
										<div class="m-widget24">
											<div class="m-widget24__item">
												<h4 class="m-widget24__title">
													Total Pengolahan
												</h4><br>
												<span class="m-widget24__stats m--font-danger">
													<?php echo $totalpengolahan->total;?>
												</span>
												<div class="m--space-10"></div>
												<br><br>
											</div>
										</div>

										<!--end::New Orders-->
									</div>
									<div class="col-md-12 col-lg-6 col-xl-3">

										<!--begin::New Users-->
										<div class="m-widget24">
											<div class="m-widget24__item">
												<h4 class="m-widget24__title">
													Total Pengiriman
												</h4><br>
												<span class="m-widget24__stats m--font-success">
													<?php echo $totalpengiriman->total;?>
												</span>
												<div class="m--space-10"></div>
												<br><br>
											</div>
										</div>

										<!--end::New Users-->
									</div>
								</div>
							</div>
						</div>

						<!--end:: Widgets/Stats-->


						<!--End::Section-->
					</div>
				
			