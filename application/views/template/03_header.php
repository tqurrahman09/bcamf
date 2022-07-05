<header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
	<div class="m-container m-container--fluid m-container--full-height">
		<div class="m-stack m-stack--ver m-stack--desktop">
			<!-- BEGIN: Brand -->
			<div class="m-stack__item m-brand  m-brand--skin-dark ">
				<div class="m-stack m-stack--ver m-stack--general">
					<div class="m-stack__item m-stack__item--middle m-brand__logo">
						<a href="<?php echo site_url(); ?>" class="m-brand__logo-wrapper">
							<img alt="" width="150px"; height="100px"; src="<?php echo base_url('assets/malindo/img/logo.png'); ?>">
						</a>
					</div>
					<div class="m-stack__item m-stack__item--middle m-brand__tools">
						<!-- BEGIN: Left Aside Minimize Toggle -->
						<a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block  ">
							<span></span>
						</a>
						<!-- END -->
						<!-- BEGIN: Responsive Aside Left Menu Toggler -->
						<a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
							<span></span>
						</a>
						<!-- END -->
						<!-- BEGIN: Responsive Header Menu Toggler -->
						<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
							<span></span>
						</a>
						<!-- END -->
						<!-- BEGIN: Topbar Toggler -->
						<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
							<i class="flaticon-more"></i>
						</a>
						<!-- BEGIN: Topbar Toggler -->
					</div>
				</div>
			</div>
			<!-- END: Brand -->
			<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
				<!-- BEGIN: Horizontal Menu -->
				<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn">
				<i class="la la-close"></i>
				</button>
				<!-- END: Horizontal Menu -->
				<!-- BEGIN: Topbar -->
				<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">
					<div class="m-stack__item m-topbar__nav-wrapper">
						<ul class="m-topbar__nav m-nav m-nav--inline">
							<!-- begin::Notifications content, quick actions, language -->
							<!-- ADD NOTIFICATIONS, QIUCK ACTIONS, LANGUAGE HERE -->
							<!-- end::Notifications content, quick actions, language -->
							<li class="m-nav__item m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width m-dropdown--skin-light	m-list-search m-list-search--skin-light" m-dropdown-toggle="click" id="m_quicksearch" m-quicksearch-mode="dropdown" m-dropdown-persistent="1">
								<a href="#" class="m-nav__link m-dropdown__toggle">
									<span class="m-nav__link-icon">
										<i class="flaticon-search-1"></i>
									</span>
								</a>
								<div class="m-dropdown__wrapper" style="z-index: 101;">
									<span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
									<div class="m-dropdown__inner ">
										<div class="m-dropdown__header">
											<form class="m-list-search__form">
												<div class="m-list-search__form-wrapper">
													<span class="m-list-search__form-icon-close" id="m_quicksearch_close">
														<i class="la la-remove"></i>
													</span>
													<span class="m-list-search__form-input-wrapper">
														<input id="m_quicksearch_input" autocomplete="off" type="text" name="q" class="m-list-search__form-input" value="" placeholder="Search...">
													</span>
												</div>
											</form>
										</div>
										<div class="m-dropdown__body">
											<div class="m-dropdown__scrollable m-scrollable m-scroller ps" data-scrollable="true" data-height="300" data-mobile-height="200" style="height: 300px; overflow: hidden;">
												<div class="m-dropdown__content">
												</div>
												<div class="ps__rail-x" style="left: 0px; bottom: 0px;">
													<div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
												</div>
												<div class="ps__rail-y" style="top: 0px; right: 4px;">
													<div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>

								
							<li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
								<a href="#" class="m-nav__link m-dropdown__toggle">
									<span class="m-topbar__userpic">
										<img src="<?php echo base_url($this->session->userdata($this->config->item('image'))); ?>" class="m--img-rounded m--marginless" alt="">
									</span>
									<span class="m-topbar__username m--hide"><?php echo $this->session->userdata($this->config->item('username')); ?></span>
								</a>
								<div class="m-dropdown__wrapper">
									<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
									<div class="m-dropdown__inner">
										<div class="m-dropdown__header m--align-center" style="background: url(<?php echo base_url('assets/metronic/app/media/img/misc/user_profile_bg.jpg'); ?>); background-size: cover;">
											<div class="m-card-user m-card-user--skin-dark">
												<div class="m-card-user__pic">
													<img src="<?php echo base_url($this->session->userdata($this->config->item('image'))); ?>" class="m--img-rounded m--marginless" alt="">
												</div>
												<div class="m-card-user__details">
													<span class="m-card-user__name m--font-weight-500"><?php echo $this->session->userdata($this->config->item('username')); ?></span>
													
												</div>
											</div>
										</div>
										<div class="m-dropdown__body">
											<div class="m-dropdown__content">
												<ul class="m-nav m-nav--skin-light">
													<li class="m-nav__section m--hide">
														<span class="m-nav__section-text">Section</span>
													</li>
													<li class="m-nav__item">
														<a href="<?php echo site_url('profil'); ?>" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-profile-1"></i>
															<span class="m-nav__link-title">
																<span class="m-nav__link-wrap">
																	<span class="m-nav__link-text">Profil</span>
																	<!-- begin::Badges if u need badge link -->
																	<!-- <span class="m-nav__link-badge">
																								<span class="m-badge m-badge--success">2</span>
																	</span> -->
																	<!-- end::badges -->
																</span>
															</span>
														</a>
													</li>
													<!-- begin::Any link list item -->
													<!-- ADD ANY LINK LIST ITEM -->
													<!-- end::Any link list item -->
													<li class="m-nav__item">
														<li class="m-nav__separator m-nav__separator--fit">
														</li>
														<li class="m-nav__item">
															<a href="<?php echo site_url('login/logout'); ?>" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</li>
								<!-- begin::Quick sidebar toggle button -->
								<!-- ADD BUTTON HERE -->
								<!-- end::Quick sidebar toggle button -->
							</ul>
						</div>
					</div>
					<!-- END: Topbar -->
				</div>
			</div>
		</div>
	</header>