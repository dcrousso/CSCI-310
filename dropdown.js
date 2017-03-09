let resultsPromise = Promise.resolve();

Array.from(document.querySelectorAll("input[type=\"search\"][name=\"a[]\"]")).forEach(input => {
	input.addEventListener("input", event => {
		while (input.nextElementSibling)
			input.nextElementSibling.remove();

		Array.from(input.form.getElementsByTagName("button")).forEach(button => {
			if (button.type === "button")
				return;

			button.disabled = !input.value;
		});

		if (!input.value || input.value.length < 3)
			return;

		let query = input.value;

		resultsPromise
		.then(() => fetch(`API.php?a=${query}`))
		.then(response => response.json())
		.then(json => new Promise((resolve, reject) => {
			while (input.nextElementSibling)
				input.nextElementSibling.remove();

			if (input.value !== query)
				return;

			let container = input.insertAdjacentElement("afterEnd", document.createElement("div"));
			container.setAttribute("id", "dropdown");
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
				image.src = "placeholder.png";
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
