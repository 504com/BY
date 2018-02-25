$(function () {
// Edit/Delete bookings inline
    $('#bookingTable').Tabledit({
        hideIdentifier: true,
        columns: {
            identifier: [0, 'bookingId'],
            editable: [[5, 'guests', '{"1": "1", "2": "2", "3": "3", "4": "4", "5": "5", "6": "6", "7": "7", "8": "8", "9": "9", "10": "10"}']]
        }
    });
});