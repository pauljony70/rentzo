var code_ajax = $("#code_ajax").val();


$(document).ready(function () {
	// Themes begin
	$('.custom_range').on('click', function () {
		get_order_data(4);
	});

	get_order_data(0);
	function get_order_data(type) {
		var li_id = $(this).closest('.dayLink').attr('id');
		var start_date = $('#start_date').val();
		var end_date = $('#end_date').val();
		//alert('ddd');
		$.ajax({
			url: "get_orderdata.php",
			type: "POST",
			data: {
				code: code_ajax,
				type: type,
				start_date: start_date,
				end_date: end_date
			},
			success: function (data) {
				//console.log(data);

				var userid = [];
				var facebook_follower = [];

				var parsedJSON = $.parseJSON(data);
				$(parsedJSON).each(function () {
					//console.log(this.Dates);
					userid.push(this.Dates);
					facebook_follower.push(this.orderid);
				});

				var chartdata = {
					labels: userid,
					datasets: [
						{
							label: "Total Orders",
							fill: false,
							lineTension: 0.1,
							backgroundColor: "rgba(59, 89, 152, 0.75)",
							borderColor: "rgba(59, 89, 152, 1)",
							pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
							pointHoverBorderColor: "rgba(59, 89, 152, 1)",
							data: facebook_follower
						}
					]
				};

				var ctx = $("#mycanvas");

				var LineGraph = new Chart(ctx, {
					type: 'line',
					data: chartdata
				});
			},
			error: function (data) {

			}
		});
	}

	$('.dropdown-menu li').on('click', function () {

		var li_id = $(this).closest('.dayLink').attr('id');

		if (li_id == 4) {
			$('.custom_div').show();
		}
		else {
			$('.custom_div').hide();
		}
		$.ajax({
			url: "get_orderdata.php",
			type: "POST",
			data: {
				code: code_ajax,
				typess: li_id

			},
			success: function (data) {
				//console.log(data);

				var userid = [];
				var facebook_follower = [];

				var parsedJSON = $.parseJSON(data);
				$(parsedJSON).each(function () {
					//console.log(this.Dates);
					userid.push(this.Dates);
					facebook_follower.push(this.orderid);
				});

				var chartdata = {
					labels: userid,
					datasets: [
						{
							label: "Total Orders",
							fill: false,
							lineTension: 0.1,
							backgroundColor: "rgba(59, 89, 152, 0.75)",
							borderColor: "rgba(59, 89, 152, 1)",
							pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
							pointHoverBorderColor: "rgba(59, 89, 152, 1)",
							data: facebook_follower
						}
					]
				};

				var ctx = $("#mycanvas");

				var LineGraph = new Chart(ctx, {
					type: 'line',
					data: chartdata
				});
			},
			error: function (data) {

			}
		});
	});


	am4core.useTheme(am4themes_animated);
	// Themes end

	//revenue chart
	revenue_chart();

	$("#revenue_ul li").on("click", "a", function (e) {
		e.preventDefault();
		var $this = $(this).parent();
		$this.addClass("select").siblings().removeClass("select");

		$("#revenue_btn").val($this.data("value"));
		$("#btn_text").text($this.text());
		revenue_chart();
	});

	//new seller chart
	/*new_seller_chart();
   
   $("#new_seller_ul li").on("click", "a", function(e){
		e.preventDefault();
		var $this = $(this).parent();
		$this.addClass("select").siblings().removeClass("select");
		
		$("#new_seller_btn").val($this.data("value"));
		$("#new_seller_btn_text").text($this.text());
		new_seller_chart();
	});
	*/
});

function revenue_chart() {
	var filter = $("#revenue_btn").val();
	get_revenue(filter);
}

function new_seller_chart() {
	var filter = $("#new_seller_btn").val();
	get_new_seller(filter);
}



function get_revenue(filter) {
	// successmsg("state id "+stateid );
	$.ajax({
		method: 'POST',
		url: 'get_reports_data.php',
		data: {
			code: code_ajax,
			type: "revenue",
			filter: filter
		},
		success: function (response) {
			var chart_data = $.parseJSON(response);

			// Create chart instance
			var chart = am4core.create("chartdiv", am4charts.XYChart);

			// Add data
			chart.data = chart_data;

			// Create axes
			var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
			dateAxis.renderer.grid.template.location = 0;
			dateAxis.renderer.minGridDistance = 50;

			var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
			valueAxis.logarithmic = true;
			valueAxis.renderer.minGridDistance = 20;

			// Create series
			var series = chart.series.push(new am4charts.LineSeries());
			series.dataFields.valueY = "price";
			series.dataFields.dateX = "date";
			series.tensionX = 0.8;
			series.strokeWidth = 3;
			series.tooltipText = "Revenue: [bold]{valueY}[/]";

			var bullet = series.bullets.push(new am4charts.CircleBullet());
			bullet.circle.fill = am4core.color("#fff");
			bullet.circle.strokeWidth = 3;

			// Add cursor
			chart.cursor = new am4charts.XYCursor();
			chart.cursor.fullWidthLineX = true;
			chart.cursor.xAxis = dateAxis;
			chart.cursor.lineX.strokeWidth = 0;
			chart.cursor.lineX.fill = am4core.color("#000");
			chart.cursor.lineX.fillOpacity = 0.1;

			// Add scrollbar
			chart.scrollbarX = new am4core.Scrollbar();

			// Add a guide
			let range = valueAxis.axisRanges.create();
			range.value = 90.4;
			range.grid.stroke = am4core.color("#396478");
			range.grid.strokeWidth = 1;
			range.grid.strokeOpacity = 1;
			range.grid.strokeDasharray = "3,3";
			range.label.inside = true;
			range.label.text = "Revenue";
			range.label.fill = range.grid.stroke;
			range.label.verticalCenter = "bottom";

		}
	});
}

function get_new_seller(filter) {
	// successmsg("state id "+stateid );
	$.ajax({
		method: 'POST',
		url: 'get_reports_data.php',
		data: {
			code: code_ajax,
			type: "new_seller",
			filter: filter
		},
		success: function (response) {
			var chart_data = $.parseJSON(response);

			// Create chart instance
			var chart = am4core.create("chartdiv_new_seller", am4charts.XYChart);

			// Add data
			chart.data = chart_data;

			// Create axes

			var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
			categoryAxis.dataFields.category = "date";
			categoryAxis.renderer.grid.template.location = 0;
			categoryAxis.renderer.minGridDistance = 30;

			categoryAxis.renderer.labels.template.adapter.add("dy", function (dy, target) {
				if (target.dataItem && target.dataItem.index & 2 == 2) {
					return dy + 25;
				}
				return dy;
			});

			var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

			// Create series
			var series = chart.series.push(new am4charts.ColumnSeries());
			series.dataFields.valueY = "seller";
			series.dataFields.categoryX = "date";
			series.name = "Seller";
			series.columns.template.tooltipText = "Seller: [bold]{valueY}[/]";
			series.columns.template.fillOpacity = .8;

			var columnTemplate = series.columns.template;
			columnTemplate.strokeWidth = 2;
			columnTemplate.strokeOpacity = 1;

		}
	});
}

