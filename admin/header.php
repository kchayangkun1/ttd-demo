<?php 
require_once 'init.php';
require_once 'auth.php';
?>
<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">

	<div class="navbar-header">
		<button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided" data-toggle="menubar">
			<span class="sr-only">Toggle navigation</span>
			<span class="hamburger-bar"></span>
		</button>
		<button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse" data-toggle="collapse">
			<i class="icon wb-more-horizontal" aria-hidden="true"></i>
		</button>
		<div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
			<span class="navbar-brand-text hidden-xs-down"> Back Office </span>
		</div>
	</div>

	<div class="navbar-container container-fluid">
		<!-- Navbar Collapse -->
		<div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
			<!-- Navbar Toolbar -->
			<ul class="nav navbar-toolbar">
				<li class="nav-item hidden-float" id="toggleMenubar">
					<a class="nav-link" data-toggle="menubar" href="#" role="button">
						<i class="icon hamburger hamburger-arrow-left">
							<span class="sr-only">Toggle menubar</span>
							<span class="hamburger-bar"></span>
						</i>
					</a>
				</li>
				<li class="nav-item hidden-sm-down" id="toggleFullscreen">
					<a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
						<span class="sr-only">Toggle fullscreen</span>
					</a>
				</li>		
			</ul>
			<!-- End Navbar Toolbar -->

			<!-- Navbar Toolbar Right -->
			<ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
				<li class="nav-item dropdown">
					<a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false" data-animation="scale-up" role="button">
						<span class="avatar avatar-online">
							<img src="assets/images/user.jpg" alt="...">
							<i></i>
						</span>
					</a>
					<div class="dropdown-menu" role="menu">
						<a class="dropdown-item" href="logout.php" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
					</div>
				</li>		
			</ul>
			<!-- End Navbar Toolbar Right -->
		</div>
		<!-- End Navbar Collapse -->
	</div>
</nav>



<div class="site-menubar">
	<div class="site-menubar-body">
		<div>
			<div>
				<ul class="site-menu" data-plugin="menu">
					<li class="site-menu-item <?php echo ( in_array($current_file, array('index.php') ) ) ? 'active' : ''; ?>">
						<a class="animsition-link" href="index.php">
							<i class="site-menu-icon icon fa-home" aria-hidden="true"></i>
							<span class="site-menu-title">Home</span>
						</a>
					</li>
					<li class="site-menu-item has-sub <?php echo ( in_array($current_file, array('order_today.php', 'order_detail.php', 'order_list.php', 'history_detail.php') ) ) ? 'active open' : ''; ?>">
						<a href="javascript:void(0)">
							<i class="site-menu-icon icon fa fa-shopping-cart" aria-hidden="true"></i>
							<span class="site-menu-title">Order</span>
							<span class="site-menu-arrow"></span>
						</a>
						<ul class="site-menu-sub">
							<li class="site-menu-item <?php echo ( in_array($current_file, array('order_today.php', 'order_detail.php') ) ) ? 'active' : ''; ?>">
								<a class="animsition-link" href="order_today.php">
									<i class="site-menu-icon icon fa-cc-paypal" aria-hidden="true"></i>
									<span class="site-menu-title">Order Today</span>
								</a>
							</li>

							<li class="site-menu-item <?php echo ( in_array($current_file, array('order_list.php', 'history_detail.php') ) ) ? 'active' : ''; ?>">
								<a class="animsition-link" href="order_list.php">
									<i class="site-menu-icon icon fa-clock-o" aria-hidden="true"></i>
									<span class="site-menu-title">All Order</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="site-menu-item has-sub <?php echo ( in_array($current_file, array('category.php', 'category_add.php', 'category_edit.php', 'categories.php', 'categories_add.php', 'categories_edit.php') ) ) ? 'active open' : ''; ?>">
						<a href="javascript:void(0)">
							<i class="site-menu-icon icon fa fa-list-alt" aria-hidden="true"></i>
							<span class="site-menu-title">Category</span>
							<span class="site-menu-arrow"></span>
						</a>
						<ul class="site-menu-sub">
							<li class="site-menu-item <?php echo ( in_array($current_file, array('category.php', 'category_add.php', 'category_edit.php') ) ) ? 'active' : ''; ?>">
								<a class="animsition-link" href="category.php">
									<i class="site-menu-icon icon fa fa-pie-chart" aria-hidden="true"></i>
									<span class="site-menu-title">Category</span>
								</a>
							</li>

							<li class="site-menu-item <?php echo ( in_array($current_file, array('categories.php', 'categories_add.php', 'categories_edit.php') ) ) ? 'active' : ''; ?>">
								<a class="animsition-link" href="categories.php">
									<i class="site-menu-icon icon fa-sitemap" aria-hidden="true"></i>
									<span class="site-menu-title">Sub Categories</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="site-menu-item <?php echo ( in_array($current_file, array('product.php', 'product_add.php', 'product_edit.php') ) ) ? 'active' : ''; ?>">
						<a class="animsition-link" href="product.php">
							<i class="site-menu-icon icon fa-product-hunt" aria-hidden="true"></i>
							<span class="site-menu-title">Product</span>
						</a>
					</li>
					<li class="site-menu-item <?php echo ( in_array($current_file, array('review.php', 'review_add.php', 'review_edit.php') ) ) ? 'active' : ''; ?>">
						<a class="animsition-link" href="review.php">
							<i class="site-menu-icon icon fa-comments" aria-hidden="true"></i>
							<span class="site-menu-title">Review</span>
						</a>
					</li>
					<!-- <li class="site-menu-item <?php echo ( in_array($current_file, array('categories.php', 'categories_add.php', 'categories_edit.php') ) ) ? 'active' : ''; ?>">
							<a class="animsition-link" href="categories.php">
							<i class="site-menu-icon icon fa fa-pie-chart" aria-hidden="true"></i>
							<span class="site-menu-title">Categories</span>
						</a>
					</li> -->
				</ul>
			</div>
		</div>
	</div>
	<div class="site-menubar-footer">
	<a href="javascript: void(0);" class="fold-show" data-placement="top" data-toggle="tooltip" data-original-title="Settings">
			<span class="icon wb-settings" aria-hidden="true"></span>
		</a>
		<a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Lock">
			<span class="icon wb-eye-close" aria-hidden="true"></span>
		</a>
		<a href="logout.php" data-placement="top" data-toggle="tooltip" data-original-title="Logout">
			<span class="icon wb-power" aria-hidden="true"></span>
		</a>
	</div>
</div>