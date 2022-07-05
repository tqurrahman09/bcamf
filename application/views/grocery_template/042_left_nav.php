<!-- BEGIN: Left Aside -->
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
<i class="la la-close"></i>
</button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
	<!-- BEGIN: Aside Menu -->
	<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
		<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
			<li class="m-menu__section ">
				<h4 class="m-menu__section-text">Menu</h4>
				<i class="m-menu__section-icon flaticon-more-v2"></i>
			</li>
			<!-- Level 1 -->
			<!-- begin::if -->
			<?php if ($this->authority->__is_super_admin() || $this->authority_view->monthly_expense) { ?>
			<li class="m-menu__item <?php if (strtolower($this->module) == 'monthly_expense') { echo "m-menu__item--active"; } ?>" aria-haspopup="true">
				<a href="<?php echo site_url('monthly-expense'); ?>" class="m-menu__link ">
					<i class="m-menu__link-icon la la-history"></i>
					<span class="m-menu__link-text">Monthly Expense</span>
				</a>
			</li>
			<?php } ?>
			<!-- end if -->
			<!-- begin::if -->
			<?php if ($this->authority->__is_super_admin() || $this->authority_view->memo_payment) { ?>
			<li class="m-menu__item <?php if (strtolower($this->module) == 'memo_payment') { echo "m-menu__item--active"; } ?>" aria-haspopup="true">
				<a href="<?php echo site_url('memo-payment'); ?>" class="m-menu__link ">
					<i class="m-menu__link-icon la la-sticky-note-o"></i>
					<span class="m-menu__link-text">Memo Payment</span>
				</a>
			</li>
			<?php } ?>
			<!-- end if -->
			<!-- begin::if -->
			<?php if ($this->authority->__is_super_admin() || $this->authority_view->petty_chash) { ?>
			<li class="m-menu__item <?php if (strtolower($this->module) == 'petty_chash') { echo "m-menu__item--active"; } ?>" aria-haspopup="true">
				<a href="<?php echo site_url('petty-chash'); ?>" class="m-menu__link ">
					<i class="m-menu__link-icon la la-archive"></i>
					<span class="m-menu__link-text">Petty Cash</span>
				</a>
			</li>
			<?php } ?>
			
			<?php if ($this->authority->__is_super_admin() || $this->authority_view->budget) { ?>
			<li class="m-menu__item <?php if (strtolower($this->module) == 'budget') { echo "m-menu__item--active"; } ?>" aria-haspopup="true">
				<a href="<?php echo site_url('budget'); ?>" class="m-menu__link ">
					<i class="m-menu__link-icon la la-archive"></i>
					<span class="m-menu__link-text">Budget</span>
				</a>
			</li>

			<?php } ?>

			<?php if ($this->authority->__is_super_admin() || $this->authority_view->supplier) { ?>
			<li class="m-menu__item <?php if (strtolower($this->module) == 'supplier') { echo "m-menu__item--active"; } ?>" aria-haspopup="true">
				<a href="<?php echo site_url('supplier'); ?>" class="m-menu__link ">
					<i class="m-menu__link-icon la la-archive"></i>
					<span class="m-menu__link-text">Supplier</span>
				</a>
			</li>

			<?php } ?>

			
			<!-- end if -->
			<!-- begin::if -->
			<?php if ($this->authority->__is_super_admin() || $this->authority_view->company || $this->authority_view->department || $this->authority_view->rekening || $this->authority_view->vehicle) { ?>
			<li class="m-menu__item  m-menu__item--submenu <?php if (strtolower($this->module) == 'company' || strtolower($this->module) == 'department' || strtolower($this->module) == 'rekening' || strtolower($this->module) == 'vehicle' || strtolower($this->module) == 'area' || strtolower($this->module) == 'customer' || strtolower($this->module) == 'supplier' || strtolower($this->module) == 'wh' || strtolower($this->module) == 'worker' || strtolower($this->module) == 'me_type' || strtolower($this->module) == 'pc_type' || strtolower($this->module) == 'mp_type'){ echo "m-menu__item--open";} ?>" aria-haspopup="true" m-menu-submenu-toggle="hover">
				<a href="javascript:;" class="m-menu__link m-menu__toggle">
					<i class="m-menu__link-icon flaticon-layers"></i>
					<span class="m-menu__link-text">Master</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu ">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item m-menu__item--parent" aria-haspopup="true">
							<span class="m-menu__link">
								<span class="m-menu__link-text">Master</span>
							</span>
						</li>
						<?php if ($this->authority->__is_super_admin() || $this->authority_view->company) { ?>
						<li class="m-menu__item <?php if (strtolower($this->module) == 'company') { echo "m-menu__item--active"; } ?>" aria-haspopup="true">
							<a href="<?php echo site_url('master/company'); ?>" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
								</i>
								<span class="m-menu__link-text">Company</span>
							</a>
						</li>
						<?php } ?>
						<?php if ($this->authority->__is_super_admin() || $this->authority_view->department) { ?>
						<li class="m-menu__item <?php if (strtolower($this->module) == 'department') { echo "m-menu__item--active"; } ?>" aria-haspopup="true">
							<a href="<?php echo site_url('master/department'); ?>" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
								</i>
								<span class="m-menu__link-text">Department</span>
							</a>
						</li>
						<?php } ?>
						<?php if ($this->authority->__is_super_admin() || $this->authority_view->rekening) { ?>
						<li class="m-menu__item <?php if (strtolower($this->module) == 'rekening') { echo "m-menu__item--active"; } ?>" aria-haspopup="true">
							<a href="<?php echo site_url('master/rekening'); ?>" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
								</i>
								<span class="m-menu__link-text">Rekening</span>
							</a>
						</li>
						<?php } ?>
						<?php if ($this->authority->__is_super_admin() || $this->authority_view->vehicle) { ?>
						<li class="m-menu__item <?php if (strtolower($this->module) == 'vehicle') { echo "m-menu__item--active"; } ?>" aria-haspopup="true">
							<a href="<?php echo site_url('master/vehicle'); ?>" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
								</i>
								<span class="m-menu__link-text">Vehicle</span>
							</a>
						</li>
						<?php } ?>
						<?php if ($this->authority->__is_super_admin() || $this->authority_view->area) { ?>
						<li class="m-menu__item <?php if (strtolower($this->module) == 'area') { echo "m-menu__item--active"; } ?>" aria-haspopup="true">
							<a href="<?php echo site_url('master/area'); ?>" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
								</i>
								<span class="m-menu__link-text">Area</span>
							</a>
						</li>
						<?php } ?>
						<?php if ($this->authority->__is_super_admin() || $this->authority_view->customer) { ?>
						<li class="m-menu__item <?php if (strtolower($this->module) == 'customer') { echo "m-menu__item--active"; } ?>" aria-haspopup="true">
							<a href="<?php echo site_url('master/customer'); ?>" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
								</i>
								<span class="m-menu__link-text">Customer</span>
							</a>
						</li>
						<?php } ?>
						<?php if ($this->authority->__is_super_admin() || $this->authority_view->supplier) { ?>
						<li class="m-menu__item <?php if (strtolower($this->module) == 'supplier') { echo "m-menu__item--active"; } ?>" aria-haspopup="true">
							<a href="<?php echo site_url('master/supplier'); ?>" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
								</i>
								<span class="m-menu__link-text">Supplier</span>
							</a>
						</li>
						<?php } ?>
						<?php if ($this->authority->__is_super_admin() || $this->authority_view->wh) { ?>
						<li class="m-menu__item <?php if (strtolower($this->module) == 'wh') { echo "m-menu__item--active"; } ?>" aria-haspopup="true">
							<a href="<?php echo site_url('master/wh'); ?>" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
								</i>
								<span class="m-menu__link-text">Warehouse</span>
							</a>
						</li>
						<?php } ?>
						<?php if ($this->authority->__is_super_admin() || $this->authority_view->worker) { ?>
						<li class="m-menu__item <?php if (strtolower($this->module) == 'worker') { echo "m-menu__item--active"; } ?>" aria-haspopup="true">
							<a href="<?php echo site_url('master/worker'); ?>" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
								</i>
								<span class="m-menu__link-text">Worker</span>
							</a>
						</li>
						<?php } ?>
						<?php if ($this->authority->__is_super_admin() || $this->authority_view->me_type) { ?>
						<li class="m-menu__item <?php if (strtolower($this->module) == 'me_type') { echo "m-menu__item--active"; } ?>" aria-haspopup="true">
							<a href="<?php echo site_url('master/me-type'); ?>" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
								</i>
								<span class="m-menu__link-text">ME Type</span>
							</a>
						</li>
						<?php } ?>
						<?php if ($this->authority->__is_super_admin() || $this->authority_view->pc_type) { ?>
						<li class="m-menu__item <?php if (strtolower($this->module) == 'pc_type') { echo "m-menu__item--active"; } ?>" aria-haspopup="true">
							<a href="<?php echo site_url('master/pc-type'); ?>" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
								</i>
								<span class="m-menu__link-text">PC Type</span>
							</a>
						</li>
						<?php } ?>
						<?php if ($this->authority->__is_super_admin() || $this->authority_view->mp_type) { ?>
						<li class="m-menu__item <?php if (strtolower($this->module) == 'mp_type') { echo "m-menu__item--active"; } ?>" aria-haspopup="true">
							<a href="<?php echo site_url('master/mp-type'); ?>" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
								</i>
								<span class="m-menu__link-text">MP Type</span>
							</a>
						</li>
						<?php } ?>
						<?php if ($this->authority->__is_super_admin() || $this->authority_view->budget) { ?>
						<li class="m-menu__item <?php if (strtolower($this->module) == 'budget') { echo "m-menu__item--active"; } ?>" aria-haspopup="true">
							<a href="<?php echo site_url('master/budget'); ?>" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
								<span></span>
								</i>
								<span class="m-menu__link-text">Budget</span>
							</a>
						</li>
						<?php } ?>
					</ul>
				</div>
			</li>
			<?php } ?>
			<!-- end if -->
			<!-- begin::if -->
			<?php if ($this->authority->__is_super_admin()) { ?>
				<li class="m-menu__section ">
				<h4 class="m-menu__section-text">Administrator</h4>
				<i class="m-menu__section-icon flaticon-more-v2"></i>
			</li>
			<li class="m-menu__item <?php if (strtolower($this->module) == 'user') { echo "m-menu__item--active"; } ?>"">
				<a href="<?php echo site_url('user'); ?>" class="m-menu__link">
					<i class="m-menu__link-icon flaticon-user-settings"></i>
					<span class="m-menu__link-text">User</span>
				</a>
			</li>
			<li class="m-menu__item <?php if (strtolower($this->module) == 'otoritas') { echo "m-menu__item--active"; } ?>"">
				<a href="<?php echo site_url('otoritas'); ?>" class="m-menu__link">
					<i class="m-menu__link-icon flaticon-settings"></i>
					<span class="m-menu__link-text">Otoritas</span>
				</a>
			</li>
			<?php } ?>
			<!-- end::if -->
		</ul>
	</div>
	<!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->