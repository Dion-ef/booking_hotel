require('./bootstrap');

import Dropzone from "dropzone";
window.Dropzone = Dropzone;

// window.Echo.channel('booking-notif')
//     .listen('NotifikasiBooking', (e) => {
//         console.log('Booking Notification:', e.bookingData);
//         alert('Booking Notification: ' + JSON.stringify(e.bookingData));
//     });