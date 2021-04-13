$(function() {
	new mxqrcode({
		debug: true,
		host: drupalSettings.campusapp.qrLogin.host,
		channel: "normal",
		success: function(msg)
		{
			$.ajax({
				url: drupalSettings.campusapp.qrLogin.posturl+'?_format=json&sessionid='+drupalSettings.campusapp.qrLogin.sessionid,
				dataType: 'json',
				success: function(data){
					if(data.status=1) alert(data.uid);
				}
			});
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
