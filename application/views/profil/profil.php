<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<!-- BEGIN: Subheader -->
	<div class="m-subheader ">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title ">My Profile</h3>
			</div>
			<!-- <div>
				<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
					<a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
						<i class="la la-plus m--hide"></i>
						<i class="la la-ellipsis-h"></i>
					</a>
					<div class="m-dropdown__wrapper">
						<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
						<div class="m-dropdown__inner">
							<div class="m-dropdown__body">
								<div class="m-dropdown__content">
									<ul class="m-nav">
										<li class="m-nav__section m-nav__section--first m--hide">
											<span class="m-nav__section-text">Quick Actions</span>
										</li>
										<li class="m-nav__item">
											<a href="" class="m-nav__link">
												<i class="m-nav__link-icon flaticon-share"></i>
												<span class="m-nav__link-text">Activity</span>
											</a>
										</li>
										<li class="m-nav__item">
											<a href="" class="m-nav__link">
												<i class="m-nav__link-icon flaticon-chat-1"></i>
												<span class="m-nav__link-text">Messages</span>
											</a>
										</li>
										<li class="m-nav__item">
											<a href="" class="m-nav__link">
												<i class="m-nav__link-icon flaticon-info"></i>
												<span class="m-nav__link-text">FAQ</span>
											</a>
										</li>
										<li class="m-nav__item">
											<a href="" class="m-nav__link">
												<i class="m-nav__link-icon flaticon-lifebuoy"></i>
												<span class="m-nav__link-text">Support</span>
											</a>
										</li>
										<li class="m-nav__separator m-nav__separator--fit">
										</li>
										<li class="m-nav__item">
											<a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">Submit</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> -->
		</div>
	</div>
	<!-- END: Subheader -->
	<div class="m-content">
		<div class="row">
			<div class="col-xl-3 col-lg-4">
				<div class="m-portlet m-portlet--full-height  ">
					<div class="m-portlet__body">
						<div class="m-card-profile">
							<div class="m-card-profile__title m--hide">
								Your Profile
							</div>
							<div class="m-card-profile__pic">
								<div class="m-card-profile__pic-wrapper">
									<img src="<?php echo $this->session->userdata($this->config->item('image')); ?>" alt="Image not found">
								</div>
							</div>
							<div class="m-card-profile__details">
								<span class="m-card-profile__name"><?php echo $this->session->userdata($this->config->item('username')); ?></span>
								<a href="" class="m-card-profile__email m-link"><?php echo $this->session->userdata($this->config->item('company_code')); ?></a>
							</div>
						</div>
						<div class="m-portlet__body-separator"></div>
						<!-- <div class="m-widget1 m-widget1--paddingless">
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h4 class="m-widget1__title">Company</h4>
										<span class="m-widget1__desc">Awerage Weekly Profit</span>
									</div>
								</div>
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h4 class="m-widget1__title">Company</h4>
										<span class="m-widget1__desc">Awerage Weekly Profit</span>
									</div>
								</div>
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h4 class="m-widget1__title">Company</h4>
										<span class="m-widget1__desc">Awerage Weekly Profit</span>
									</div>
								</div>
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h4 class="m-widget1__title">Company</h4>
										<span class="m-widget1__desc">Awerage Weekly Profit</span>
									</div>
								</div>
							</div>
						</div> -->
					</div>
				</div>
			</div>
			<div class="col-xl-9 col-lg-8">
				<div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
					<div class="m-portlet__head">
						<div class="m-portlet__head-tools">
							<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
								<li class="nav-item m-tabs__item">
									<a class="nav-link m-tabs__link active show" data-toggle="tab" href="#m_user_profile_tab_2" role="tab" aria-selected="false">
										Change Password
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="tab-content">
						<div class="tab-pane active show" id="m_user_profile_tab_2">
							<?php echo form_open('', array('class' => 'm-form m-form--fit m-form--label-align-right', 'id' => 'mal-form-changepassword')); ?>
								<div class="m-portlet__body">
									<div class="form-group m-form__group m--margin-top-10 m--hide">
										<div class="alert m-alert m-alert--default" role="alert">
											The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.
										</div>
									</div>
									<div class="form-group m-form__group row">
										<div class="col-10 ml-auto">
											<h3 class="m-form__section">Change Password</h3>
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label for="example-text-input" class="col-2 col-form-label">Current Password</label>
										<div class="col-7">
											<input class="form-control m-input" type="password" name="cur_password" id="cur-password">
											<span class="m-form__help">Please enter a current password.</span>
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label for="example-text-input" class="col-2 col-form-label">New Password</label>
										<div class="col-7">
											<input class="form-control m-input" type="password" name="new_password" id="new-password" readonly="">
											<span class="m-form__help">Please enter a new password.</span>
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label for="example-text-input" class="col-2 col-form-label">Reenter New Password</label>
										<div class="col-7">
											<input class="form-control m-input" type="password" name="re_newpassword" id="re-newpassword" readonly="">
											<span class="m-form__help">Please enter a new password, it must be same with new password.</span>
										</div>
									</div>
								</div>
								<div class="m-portlet__foot m-portlet__foot--fit">
									<div class="m-form__actions">
										<div class="row">
											<div class="col-2">
											</div>
											<div class="col-7">
												<button type="submit" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--air" id="btn-changepassword">Save changes</button>
											</div>
										</div>
									</div>
								</div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>