<?php header('Access-Control-Allow-Origin: *'); ?>
<div class="m-list-search__results">
	<?php if ($data->num_rows() == 0) { ?>
		<span class="m-list-search__result-message">
			No menus found
		</span>
	<?php } else { ?>
		<span class="m-list-search__result-category m-list-search__result-category--first">
			Menus
		</span>
		<?php foreach ($data->result() as $value) { ?>
			<a href="<?php echo site_url($value->module_name); ?>" class="m-list-search__result-item">
				<span class="m-list-search__result-item-icon"><i class="la la-tag m--font-info"></i></span>
				<span class="m-list-search__result-item-text"><?php echo ucfirst(strtolower($value->alias.': '.$value->note)); ?></span>
			</a>
		<?php } ?>
	<?php } ?>
</div>