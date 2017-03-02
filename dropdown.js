let resultsPromise = Promise.resolve();

Array.from(document.querySelectorAll("input[type=\"search\"][name=\"a[]\"]")).forEach(input => {
	input.addEventListener("input", event => {
		while (input.nextElementSibling)
			input.nextElementSibling.remove();

		if (!input.value)
			return;

		resultsPromise
		.then(() => fetch(`API.php?a=${input.value}`))
		.then(response => response.json())
		.then(json => new Promise((resolve, reject) => {
			while (input.nextElementSibling)
				input.nextElementSibling.remove();

			let container = input.insertAdjacentElement("afterEnd", document.createElement("div"));
			if (!json.length) {
				container.textContent = "No Results";
				resolve();
				return;
			}

			json.forEach(artist => {
				let item = container.appendChild(document.createElement("div"));
				item.addEventListener("click", event => {
					input.value = artist;
					container.remove();
				});

				let image = item.appendChild(document.createElement("img"));
				image.src = "artist_placeholder.png";
				fetch(`https://www.googleapis.com/customsearch/v1?cx=011210812122224081716:7jq1q7stggg&key=AIzaSyDgFgO4JBA-O9yyGjlq0vcHVCOqlyP4BNk&q=${artist}`)
				.then(response => response.json())
				.then(json => {
					if (json["items"])
						image.src = json["items"][0]["pagemap"]["imageobject"][0]["url"];
				});

				item.appendChild(document.createTextNode(artist));
			});

			resolve();
		}));
	});
});
