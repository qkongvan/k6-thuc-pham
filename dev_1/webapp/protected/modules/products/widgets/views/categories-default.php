<div class="wd-category-tree">
	<ul>
		<li>
			<a href="javascript:void(0);">Computer</a>
			<ul>
				<li>
					<a href="javascript:void(0);">Laptop</a>
					<ul>
						<li>
							<a href="javascript:void(0);">Acer</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:void(0);">Desktop</a>
				</li>
				<li>
					<a href="javascript:void(0);">Mouse</a>
				</li>
				<li>
					<a href="javascript:void(0);">Keyboard</a>
				</li>
			</ul>
		</li>
	</ul>
</div>
<?php if (in_array(APPLICATION_SCOPE, array("SITE_MANAGER", "TEMPLATE_MANAGER")) && $_SERVER['HTTP_HOST'] != JLTL_PREVIEW_DOMAIN) : ?>
<div>
    <a class="dialog_link" href="<?php echo JLRouter::createAbsoluteUrl('/products/manage_categories/admin'); ?>"><?php echo ProductsModule::t('Manage Categories')?></a>
</div>
<?php endif ?>