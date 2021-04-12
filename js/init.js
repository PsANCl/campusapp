$(function() {
	new mxqrcode({
		debug: true,
		host: drupalSettings.campusapp.qrLogin.host,
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
			"apiUrl": drupalSettings.campusapp.qrLogin.posturl,
			"apiKey": drupalSettings.campusapp.qrLogin.apisource,
			"session": drupalSettings.campusapp.qrLogin.sessionid,
		},
		div: "#qrcode",
		title: drupalSettings.campusapp.qrLogin.pagetitle,
		scanfinish: function(msg)
		{
			console.log(msg);
		}
	});
});