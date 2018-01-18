$(function() {
    bookingDayNumber = $('input[name="bookingDayNumber"]').val();
    id = $('input[name="id"]').val();
    bookingDate = $('input[name="bookingDate"]').val();

    if(typeof  bookingDayNumber != 'undefined' &&  typeof id != 'undefined'  && typeof bookingDate != 'undefined' ){
        url = laroute.route('workhours.index', {id: $('input[name="id"]').val(), day: $('input[name="bookingDayNumber"]').val()});
        $.get(url, {
            date: $('input[name="bookingDate"]').val()
        }, function (data) {
            $('select[name="time"]').html(data);
        });
        $(document.activeElement).blur();
    }
    let options = {
        monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        today: 'Aujourd\'hui',
        clear: 'Effacer',
		min: true,
        formatSubmit: 'yyyy-mm-dd',
        format: 'd mmmm yyyy',
        firstDay: 1,
        onClose: function() {
            let day = this.get('select').day;

            if (day == 0) {
                day = 7;
            }
            let id = $('input[name="id"]').val();
            let url = laroute.route('workhours.index', {id: id, day: day});
            let date = this.get('select').obj;
            $.get(url, {
                date: date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate()
            }, function (data) {
                $('select[name="time"]').html(data);
            });

            $(document.activeElement).blur();
        }
    };
    pathname = $(location).attr('pathname').substr(-15);
	if (pathname == 'bookings/create') {
		$('input[name="date"]').pickadate(options);
	}
    regexEditeBooking = new RegExp('booking/edit');
    if (regexEditeBooking.test(pathname)) {
        $('input[name="date"]').pickadate(options);
    }
});
