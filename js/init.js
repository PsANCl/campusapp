$(function() {
	new mxqrcode({
		debug: true,
		host: drupalSettings.campusapp.campusapp-qrlogin.host,
		channel: "normal",
		success: function(msg)
		{
			console.log(msg);
		},
		error: function(msg)
		{
			console.log(msg);
		},
		ext: {
			"apiUrl": drupalSettings.campusapp.campusapp-qrlogin.posturl,
			"apiKey": drupalSettings.campusapp.campusapp-qrlogin.apisource,
		},
		div: "#qrcode",
		title: drupalSettings.campusapp.campusapp-qrlogin.pagetitle,
		scanfinish: function(msg)
		{
			console.log(msg);
		}
	});
});