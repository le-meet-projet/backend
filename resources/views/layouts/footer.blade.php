 
	 
		<!-- JQuery min js -->

		<script src="/assets/plugins/jquery/jquery.min.js"></script>

		<!-- Bootstrap Bundle js -->
		<script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

		<!-- Ionicons js -->
		<script src="/assets/plugins/ionicons/ionicons.js"></script>

		<!-- Moment js -->
		<script src="/assets/plugins/moment/moment.js"></script>

		<!--Internal Sparkline js -->
		<script src="/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

		<!-- Moment js -->
		<script src="/assets/plugins/raphael/raphael.min.js"></script>

		<!-- Internal Piety js -->
		<script src="/assets/plugins/peity/jquery.peity.min.js"></script>

		<!--Internal  Flot js-->
		<script src="/assets/plugins/jquery.flot/jquery.flot.js"></script>
		<script src="/assets/plugins/jquery.flot/jquery.flot.pie.js"></script>
		<script src="/assets/plugins/jquery.flot/jquery.flot.resize.js"></script>
		<script src="/assets/plugins/jquery.flot/jquery.flot.categories.js"></script>
		<script src="/assets/js/dashboard.sampledata.js"></script>
		<script src="/assets/js/chart.flot.sampledata.js"></script>

		<!-- Sticky js -->
		<script src="/assets/js/sticky.js"></script>

		<!-- Rating js-->
		<script src="/assets/plugins/rating/jquery.rating-stars.js"></script>
		<script src="/assets/plugins/rating/jquery.barrating.js"></script>

		<!-- P-scroll js -->
		<script src="/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="/assets/plugins/perfect-scrollbar/p-scroll.js"></script>

		<!-- Horizontalmenu js-->
		<script src="/assets/plugins/sidebar/sidebar-rtl.js"></script>
		<script src="/assets/plugins/sidebar/sidebar-custom.js"></script>

		<!-- Eva-icons js -->
		<script src="/assets/js/eva-icons.min.js"></script>

		<!--Internal Apexchart js-->
		<script src="/assets/js/apexcharts.js"></script>

		<!-- Horizontalmenu js-->
		<script src="/assets/plugins/horizontal-menu/horizontal-menu-2/horizontal-menu.js"></script>

		<!-- Internal Map -->
		<script src="/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
		<script src="/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

		<!-- Internal Chart js -->
		<script src="/assets/plugins/chart.js/Chart.bundle.min.js"></script>

		<!--Internal  index js -->
		<script src="/assets/js/index-dark.js"></script>
		<script src="/assets/js/jquery.vmap.sampledata.js"></script>

		<!-- custom js -->
		<script src="/assets/js/custom.js"></script>
		<script src="/assets/js/jquery.vmap.sampledata.js"></script>
		<script src="/assets/js/pass.js"></script>
		<script src="../public/js/app.js"></script>
		<script src="jquery.printPage.js"></script>
		<script src="/assets/js/sweetalert.js"></script>
		<script type="text/javascript">
			$('#print').click(function() {
				$('.container').printThis();
			});
		</script>
		<script>
		  	@if(session('status'))	 
				swal({
						title: '	{{ session('status') }}',
						
						icon: '{{ session('statuscode') }}',
						button: "OK!",
					});			 
								 
			@endif
		</script>
		<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?v=3.exp&amp;libraries=places&amp;key=AIzaSyDwFc97AGfeqzqBmL2eVFxgeHm-CQNnvNM"></script>

		<script>
		@if(isset($content))
			var latitude = {{ $content->latitude }};
			var longitude = {{ $content->latitude }};
		@else
			var latitude = 24.716;
			var longitude = 46.683;
		@endif
			if($("#latitude").val() && $("#longitude").val() ){
				var latitude = $("#latitude").val();
				var longitude = $("#longitude").val();
			}

			var map = new google.maps.Map(document.getElementById('map_canvas'), {
				zoom: 12,
				center: new google.maps.LatLng(latitude, longitude),
				mapTypeId: google.maps.MapTypeId.ROADMAP
			});

			var myMarker = new google.maps.Marker({
				position: new google.maps.LatLng(latitude, longitude),
				draggable: true
			});

			google.maps.event.addListener(myMarker, 'dragend', function (evt) {    
				$('#latitude').val(evt.latLng.lat().toFixed(3));
				$('#longitude').val(evt.latLng.lng().toFixed(3));
			});


			map.setCenter(myMarker.position);
			myMarker.setMap(map);
		</script>
</body>
</html>
 