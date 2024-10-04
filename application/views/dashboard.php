<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('template/head') ?>

<body>

	<!-- Main navbar -->
	<?php $this->load->view('template/navbar') ?>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<?php $this->load->view('template/sidebar') ?>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header">
				<div class="page-header-content">
					<div class="page-title row">
						<div class="col-lg-6 col-12">
							<h4><i class="icon-home4 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></h4>
						</div>
						<form action="" method="POST" class="row col-lg-6 col-12 mb-3">
							<div class="col-4 p-2 text-right">
								Tahun :
							</div>
							<div class="col-6 border rounded">
								<select name="tahun_akademik" class="form-control select-search" data-fouc required>
									<?php
									$mulai = 2016;
									$ajaran = "";
									for ($i = date('Y'); $i > $mulai; $i--) {
										$select = "";
										if ($i . '/' . ($i + 1) == $tahunajaran) {
											$select = "selected";
										} ?>
										<option <?= $select ?> value="<?= $i . '/' . ($i + 1) ?>"><?= $i . '/' . ($i + 1) ?></option>
									<?php  } ?>
								</select>
							</div>
							<div class="col-2 pr-0">
								<button class="btn bg-lp3i btn-block" type="submit"><i class="icon-search4"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- /page header -->

			<!-- Content area -->
			<div class="content pt-0">

				<!-- Main charts -->
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header header-elements-inline card-header-bg">
								<h5 class="card-title">Report Kesediaan Mengajar</h5>
								<div class="header-elements">
									<div class="list-icons">
										<a class="list-icons-item" data-action="collapse"></a>
										<a class="list-icons-item" data-action="remove"></a>
									</div>
								</div>
							</div>

							<div class="card-body pt-4">
								<div class="chart-container">
									<div class="chart has-fixed-height" id="report_aplikan_1"></div>
								</div>
							</div>

						</div>
					</div>
				</div>
				<!-- /dashboard content -->

			</div>
			<!-- /content area -->

			<!-- Footer -->
			<?php $this->load->view('template/footer') ?>
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->
</body>
<?php
$jmle = $jmlb - $jmlc;
$jmld = $jmla - $jmlb;
?>
<script>
	/*
	|--------------------------------------------------------------------------
	| Report Aplikan 1
	|--------------------------------------------------------------------------
	*/
	var report_aplikan_1 = document.getElementById('report_aplikan_1');
	// Initialize chart
	var reportaplikan1 = echarts.init(report_aplikan_1);
	//
	// Chart config
	//
	// Common styles
	var dataStyle = {
		normal: {
			borderWidth: 1,
			borderColor: '#fff',
			label: {
				show: false
			},
			labelLine: {
				show: false
			}
		}
	};
	var placeHolderStyle = {
		normal: {
			color: 'transparent',
			borderWidth: 0
		}
	};

	// Options
	reportaplikan1.setOption({

		// Colors
		color: [
			'#ddd', '#8edcea', '#083470', '#ffb980', '#d87a80',
			'#8d98b3', '#e5cf0d', '#97b552', '#95706d', '#dc69aa',
			'#07a2a4', '#9a7fd1', '#588dd5', '#f5994e', '#c05050',
			'#59678c', '#c9ab00', '#7eb00a', '#6f5553', '#c14089'
		],

		// Global text styles
		textStyle: {
			fontFamily: 'Roboto, Arial, Verdana, sans-serif',
			fontSize: 13
		},

		// Add title
		title: {
			text: 'Report Kesediaan',
			subtext: '<?= $tahunajaran ?>',
			left: 'center',
			top: '45%',
			textStyle: {
				color: '#083470',
				fontSize: 19,
				fontWeight: 500
			},
			subtextStyle: {
				fontSize: 12
			}
		},

		// Add tooltip
		tooltip: {
			trigger: 'item',
			backgroundColor: 'rgba(0,0,0,0.75)',
			padding: [10, 15],
			textStyle: {
				fontSize: 13,
				fontFamily: 'Roboto, sans-serif'
			},
			formatter: function(params) {
				if (params.color == "transparent") return;
				return params.percent + '%' + ' - ' + params.seriesName;
			}
		},

		// Add legend
		legend: {
			orient: 'vertical',
			top: '5%',
			left: (report_aplikan_1.offsetWidth / 2) + 20,
			data: ['<?php echo $jmla; ?> Total Kesediaan', '<?php echo $jmlb; ?> Kesediaan Diterima', '<?php echo $jmlc; ?> Kesediaan Ditolak'],
			itemHeight: 8,
			itemWidth: 8,
			itemGap: 15
		},

		// Add series
		series: [{
				name: 'Total Kesediaan',
				type: 'pie',
				cursor: 'default',
				clockWise: false,
				radius: ['75%', '90%'],
				hoverOffset: 0,
				itemStyle: dataStyle,
				data: [{
						value: <?php echo $jmla; ?>,
						name: '<?php echo $jmla; ?> Total Kesediaan'
					},
					{
						value: 0,
						name: '',
						itemStyle: placeHolderStyle
					}
				]
			},

			{
				name: 'Kesediaan Diterima',
				type: 'pie',
				cursor: 'default',
				clockWise: false,
				radius: ['60%', '75%'],
				hoverOffset: 0,
				itemStyle: dataStyle,
				data: [{
						value: <?php echo $jmlb; ?>,
						name: '<?php echo $jmlb; ?> Kesediaan Diterima'
					},
					{
						value: <?= $jmld ?>, //value 5 itu di ambil dari jumlah total use - aplikan daftar
						name: 'invisible',
						silent: false,
						itemStyle: placeHolderStyle
					}
				]
			},

			{
				name: 'Kesediaan Ditolak',
				type: 'pie',
				cursor: 'default',
				clockWise: false,
				radius: ['45%', '60%'],
				hoverOffset: 0,
				itemStyle: dataStyle,
				data: [{
						value: <?php echo $jmlc; ?>,
						name: '<?php echo $jmlc; ?> Kesediaan Ditolak'
					},
					{
						value: <?= $jmle ?>, //15 = 25-10, 25 aplikan daftar, 10 aplikan regis
						name: 'invisible',
						itemStyle: placeHolderStyle
					}
				]
			}
		]
	});
	/*
	|--------------------------------------------------------------------------
	| /Report Aplikan 1
	|--------------------------------------------------------------------------
	*/

	// Resize function
	var triggerChartResize = function() {
		report_aplikan_1 && reportaplikan1.resize();
	};
	// On sidebar width change
	$(document).on('click', '.sidebar-control', function() {
		setTimeout(function() {
			triggerChartResize();
		}, 0);
	});
	// On window resize
	var resizeCharts;
	window.onresize = function() {
		clearTimeout(resizeCharts);
		resizeCharts = setTimeout(function() {
			triggerChartResize();
		}, 200);
	};
</script>

</html>