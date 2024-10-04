<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md bg-lp3i">

	<!-- Sidebar mobile toggler -->
	<div class="sidebar-mobile-toggler text-center bg-lp3i">
		<a href="#" class="sidebar-mobile-main-toggle">
			<i class="icon-arrow-left8"></i>
		</a>
		Navigation
		<a href="#" class="sidebar-mobile-expand">
			<i class="icon-screen-full"></i>
			<i class="icon-screen-normal"></i>
		</a>
	</div>
	<!-- /sidebar mobile toggler -->


	<!-- Sidebar content -->
	<div class="sidebar-content">

		<!-- User menu -->
		<div class="sidebar-user-material">
			<div class="sidebar-user-material-body">
				<div class="card-body text-center">
					<a href="#">
						<img src="<?= base_url() ?>/global_assets/images/foto/user.png" class="img-fluid rounded-circle shadow-1 mb-3" width="80" height="80" alt="">
					</a>
					<h4 class="mb-0 text-white text-shadow-dark text-outline text-lp3i"><b><?= $this->session->userdata('nama') ?></b></h4>
					<span class="font-size-sm text-white text-shadow-dark text-outline text-lp3i"><b><?= $this->session->userdata('akses') ?></b></span>
				</div>

				<div class="sidebar-user-material-footer">
					<a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle" data-toggle="collapse"><span>My account</span></a>
				</div>
			</div>

			<div class="collapse" id="user-nav">
				<ul class="nav nav-sidebar">
					<li class="nav-item">
						<a href="{{ URL::to('profile') }}" class="nav-link">
							<i class="icon-user-plus icon-sidebar"></i>
							<span>My profile</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<!-- /user menu -->


		<!-- Main navigation -->
		<?php if ($this->session->userdata('akses') == 'Pendidikan') { ?>
			<div class="card card-sidebar-mobile">
				<ul class="nav nav-sidebar" data-nav-type="accordion">

					<!-- Main -->
					<li class="nav-item-header">
						<div class="text-uppercase font-size-xs line-height-xs">Main</div>
						<i class="icon-menu" title="Main"></i>
					</li>

					<li class="nav-item">
						<a href="<?= base_url() ?>pendidikan" class="nav-link">
							<i class="icon-home4 icon-sidebar"></i>
							<span class="text-sidebar">
								Dashboard
							</span>
						</a>
					</li>
					<li class="nav-item nav-item-submenu">
						<a href="#" class="nav-link"><i class="icon-folder4 icon-sidebar"></i> <span class="text-sidebar">Master</span></a>
						<ul class="nav nav-group-sub" data-submenu-title="Laporan" style="display: none;">
							<li class="nav-item">
								<a href="<?= base_url() ?>pendidikan/jurusan" class="nav-link text-sidebar">
									Jurusan
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url() ?>pendidikan/matkul" class="nav-link text-sidebar">
									Mata Kuliah
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url() ?>pendidikan/jadwal" class="nav-link text-sidebar">
									Jadwal
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url() ?>pendidikan/users" class="nav-link text-sidebar">
									User
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item">
						<a href="<?= base_url() ?>pendidikan/kesediaan" class="nav-link">
							<i class="icon-graduation2 icon-sidebar"></i>
							<span class="text-sidebar">
								Kesediaan Mengajar
							</span>
						</a>
					</li>
					<li class="nav-item nav-item-submenu">
						<a href="#" class="nav-link"><i class="icon-file-empty icon-sidebar"></i> <span class="text-sidebar">Laporan</span></a>
						<ul class="nav nav-group-sub" data-submenu-title="Laporan" style="display: none;">
							<li class="nav-item">
								<a href="<?= base_url() ?>pendidikan/laporankesediaan" class="nav-link text-sidebar">
									Kesediaan Mengajar
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item">
						<a href="<?= base_url() ?>login/logout" class="nav-link">
							<i class="icon-switch2 icon-sidebar"></i>
							<span class="text-sidebar">
								Logout
							</span>
						</a>
					</li>
				</ul>
			</div>
		<?php } else { ?>
			<div class="card card-sidebar-mobile">
				<ul class="nav nav-sidebar" data-nav-type="accordion">

					<!-- Main -->
					<li class="nav-item-header">
						<div class="text-uppercase font-size-xs line-height-xs">Main</div>
						<i class="icon-menu" title="Main"></i>
					</li>

					<li class="nav-item">
						<a href="<?= base_url() ?>dosen" class="nav-link">
							<i class="icon-home4 icon-sidebar"></i>
							<span class="text-sidebar">
								Dashboard
							</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url() ?>login/logout" class="nav-link">
							<i class="icon-switch2 icon-sidebar"></i>
							<span class="text-sidebar">
								Logout
							</span>
						</a>
					</li>
				</ul>
			</div>
		<?php } ?>
		<!-- /main navigation -->

	</div>
	<!-- /sidebar content -->

</div>
