function request(url, params, callback) {
	let xhr = new XMLHttpRequest;

	xhr.addEventListener("readystatechange", function(event) {
		if (xhr.readyState !== XMLHttpRequest.DONE)
			return;

		callback(xhr);
	});

	let encoded = [];
	if (params) {
		for (let key in params)
			encoded.push(encodeURIComponent(key) + "=" + encodeURIComponent(params[key]));
	}

	xhr.open("GET", url, true);
	xhr.send(encoded.join("&").replace(/%20/g, "+"));
}
