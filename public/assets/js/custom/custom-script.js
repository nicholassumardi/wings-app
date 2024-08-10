/*================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 5.0
	Author: PIXINVENT
	Author URL: https://themeforest.net/user/pixinvent/portfolio
================================================================================

NOTE:
------
PLACE HERE YOUR OWN JS CODES AND IF NEEDED.
WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR CUSTOM SCRIPT IT'S BETTER LIKE THIS. */

$(function() {
	$('#loader').fadeOut();
});

function openLoader(){
	$('#loader').fadeIn();
}

function closeLoader(){
	$('#loader').fadeOut();
}


function notif(type, background, message) {
	new Noty({
	   theme: ' alert ' + background + ' text-white alert-styled-left p-0',
	   text: message,
	   type: type,
	   timeout: 1000
	}).show();
 }

 
function formatRupiah(angka){
	var number_string = angka.value.replace(/[^,\d]/g, '').toString(),
	split   		= number_string.split(','),
	sisa     		= split[0].length % 3,
	rupiah     		= split[0].substr(0, sisa),
	ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
	if(ribuan){
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}
 
	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	angka.value = rupiah;
}