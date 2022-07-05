<!-- BEGIN: Left Aside -->
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
<i class="la la-close"></i>
</button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark " style="max-width: 20%;">
	<!-- BEGIN: Aside Menu -->
	<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
		<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
			<!-- begin::if -->
			<?php if ($this->authority->__is_super_admin()) { ?>
			<li class="m-menu__item <?php if (strtolower($this->module) == 'user') { echo "m-menu__item--active"; } ?>">
				<a href="<?php echo site_url('user'); ?>" class="m-menu__link">
					<i class="m-menu__link-icon flaticon-list"></i>
					<span class="m-menu__link-text">List Barang</span>
				</a>
			</li>
			<!-- <li class="m-menu__item <?php if (strtolower($this->module) == 'otoritas') { echo "m-menu__item--active"; } ?>"">
				<a href="<?php echo site_url('otoritas'); ?>" class="m-menu__link">
					<i class="m-menu__link-icon flaticon-settings"></i>
					<span class="m-menu__link-text">Otoritas</span>
				</a>
			</li> -->
			<?php } ?>
			<!-- end::if -->
		</ul>
	</div>
	<!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->