$(function () {
	// LISTE DES RESTAURANTS
	$('.dataTableList').DataTable({
		"paging": true,
		"lengthChange": true,
		"searching": true,
		"ordering": true,
		"autoWidth": true,
		"info": true,
		"language": {
			"emptyTable": "",
			"info": "Page _PAGE_ sur _PAGES_",
			"lengthMenu": "Afficher _MENU_ par page",
			"infoEmpty": "Pas de donnée",
			"infoFiltered": "( _MAX_ entrées filtrés )",
			"zeroRecords": "Aucun résultat"
		},
	});
	if ($(location).attr('pathname') == '/') {
		$.get($(location).attr('pathname') +'chart', function (r) {
			chart.series[0].update({
				data: [r[1].bookings,r[2].bookings,r[3].bookings,r[4].bookings,r[5].bookings,r[6].bookings,r[7].bookings,r[8].bookings,r[9].bookings,r[10].bookings,r[11].bookings,r[12].bookings,]
			});
			chart.series[1].update({
				data: [r[1].orders,r[2].orders,r[3].orders,r[4].orders,r[5].orders,r[6].orders,r[7].orders,r[8].orders,r[9].orders,r[10].orders,r[11].orders,r[12].orders,]
			});
		});
		var chart = Highcharts.chart('container', {
			chart: {
				type: 'column'
			},
			title: {
				text: 'Réservations/Commandes par mois'
			},
			xAxis: {
				categories: [
					'Janvier',
					'Février',
					'Mars',
					'Avril',
					'Mai',
					'Juin',
					'Juillet',
					'Aout',
					'Septembre',
					'Octobre',
					'Novembre',
					'Décembre'
				],
				crosshair: true
			},
			yAxis: {
				min: 0,
				tickInterval:1,
				title: {
					text: 'Quantité'
				}
			},
			tooltip: {
				headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
				pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
					'<td style="padding:0"><b>{point.y}</b></td></tr>',
				footerFormat: '</table>',
				shared: true,
				useHTML: true
			},
			plotOptions: {
				column: {
					pointPadding: 0.2,
					borderWidth: 0
				}
			},
			series: [{
				name: 'Réservations',
				data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54]
			}, {
				name: 'Commandes anticipées',
				data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]
			}]
		});
	}
	if ($(location).attr('pathname').substring(0,16) == '/restaurant/show') {
		var restaurant_id = $(location).attr('pathname').substring(17,21);
		$.get(laroute.action('manager.chart.show', {id : restaurant_id}), function (r) {
			chart.series[0].update({
				data: [r[1].bookings,r[2].bookings,r[3].bookings,r[4].bookings,r[5].bookings,r[6].bookings,r[7].bookings,r[8].bookings,r[9].bookings,r[10].bookings,r[11].bookings,r[12].bookings,]
			});
			chart.series[1].update({
				data: [r[1].orders,r[2].orders,r[3].orders,r[4].orders,r[5].orders,r[6].orders,r[7].orders,r[8].orders,r[9].orders,r[10].orders,r[11].orders,r[12].orders,]
			});
		});
		var chart = Highcharts.chart('container', {
			chart: {
				type: 'column'
			},
			title: {
				text: 'Réservations/Commandes par mois'
			},
			xAxis: {
				categories: [
					'Janvier',
					'Février',
					'Mars',
					'Avril',
					'Mai',
					'Juin',
					'Juillet',
					'Aout',
					'Septembre',
					'Octobre',
					'Novembre',
					'Décembre'
				],
				crosshair: true
			},
			yAxis: {
				min: 0,
				tickInterval:1,
				title: {
					text: 'Quantité'
				}
			},
			tooltip: {
				headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
				pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
					'<td style="padding:0"><b>{point.y}</b></td></tr>',
				footerFormat: '</table>',
				shared: true,
				useHTML: true
			},
			plotOptions: {
				column: {
					pointPadding: 0.2,
					borderWidth: 0
				}
			},
			series: [{
				name: 'Réservations',
				data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54]
			}, {
				name: 'Commandes anticipées',
				data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]
			}]
		});
	}
});
