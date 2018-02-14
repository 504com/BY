$(function () {
	// localSTORAGE
	if (localStorage) {
		var notifUrl = $(location).attr('origin') + '/notification';

		$.get(notifUrl, function (r) {

			var today = new Date().toLocaleDateString();
			var datas_json = localStorage.getItem("datas");
			var datas = JSON.parse(datas_json);
			if (!datas) {
				var datas  = {
				  day : today,
				  bookings : r.length
				};
				var datas_json = JSON.stringify(datas);
				localStorage.setItem("datas", datas_json);
			}

			if (datas.day != today) {
				var resetLocalStorage = {
					day: today,
					bookings : r.length
				};
				var reset_json = JSON.stringify(resetLocalStorage);
				localStorage.setItem('datas', reset_json);
			}

			if ((r.length > datas.bookings) || (datas.bookings > 0)) {
				var number = r.length - datas.bookings;
				$('#notification').addClass('label-warning').html(number);

				if (number == 1 ) {
					$('#notifMessage').html('Vous avez '+number+' nouvelle réservation');
					var setNotification = {
						day: today,
						bookings : r.length
					};
					var update_json = JSON.stringify(setNotification);
					localStorage.setItem('datas', update_json);
				}
				else
				{
					$('#notifMessage').html('Vous avez '+number+' nouvelles réservations');
					var setNotification = {
						day: today,
						dayBookings : r.length
					};
					var update_json = JSON.stringify(setNotification);
					localStorage.setItem('datas', update_json);
				}
			}
		});
	}
	// EDIT PRODUCTS
	$('#edit-option').change(function () {
		var baseUrl = $(this).data('url');
		var url = baseUrl + laroute.action('products.show', {'id' : this.value});
		$.get(url, function (r) {
			$('#edit-name').val(r.name);
			$('#edit-description').val(r.description);
			$('#edit-price').val(r.price);
			$('#edit-category').val(r.category_id);
		});
	});
	// Edit/Delete bookings inline
    $('#bookingTable').Tabledit({
        hideIdentifier: true,
        columns: {
            identifier: [0, 'bookingId'],
            editable: [[5, 'guests', '{"1": "1", "2": "2", "3": "3", "4": "4", "5": "5", "6": "6", "7": "7", "8": "8", "9": "9", "10": "10"}']]
        }
    });

	// DETAILS
	$('.detailList').DataTable({
		"paging": false,
		"lengthChange": true,
		"searching": false,
		"ordering": true,
		"autoWidth": true,
		"info": false,
		"language": {
			"emptyTable": "",
			"infoFiltered": "( _MAX_ entrées filtrés )",
			"zeroRecords": "Aucun produit trouvé"
		}
	});
	// LISTE DES PRODUITS
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
	// FORMULAIRE MODIFICATION
	if ($(location).attr('pathname') == '/workhours') {
		$('.timepicker').pickatime({
			format: 'H:i',
			clear: 'Annuler'
		});
	}
	// WORKHOURS
	$('#addWorkhour').click(function (e){
		e.preventDefault();
		$.get("/workhours/form", function (htmlForm) {
			$('#workhours').append(htmlForm);
			$('.timepicker').pickatime({
				format: 'H:i',
				clear: 'Annuler'
			});
		});
	});
	// PAGE BILAN
	if ($(location).attr('pathname') == '/bilan') {
		$.get($(location).attr('pathname') +'/chart', function (r) {
			chart.series[0].update({
				data: [r[1].bookings,r[2].bookings,r[3].bookings,r[4].bookings,r[5].bookings,r[6].bookings,r[7].bookings,r[8].bookings,r[9].bookings,r[10].bookings,r[11].bookings,r[12].bookings,]
			});
			chart.series[1].update({
				data: [r[1].orders,r[2].orders,r[3].orders,r[4].orders,r[5].orders,r[6].orders,r[7].orders,r[8].orders,r[9].orders,r[10].orders,r[11].orders,r[12].orders,]
			});
		});

		var chart = Highcharts.chart('chartContainer', {
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
				data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

			}, {
				name: 'Commandes anticipées',
				data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]
			}]
		});
	}
});
