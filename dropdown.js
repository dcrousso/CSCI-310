Array.from(document.querySelectorAll("input[type=\"search\"][name=\"a[]\"]")).forEach(input => {
	input.addEventListener("input", event => {
		fetch(`API.php?a=${input.value}`)
		.then(response => response.json())
		.then(json => {
			while (input.nextElementSibling)
				input.nextElementSibling.remove();

			let container = input.insertAdjacentElement("afterEnd", document.createElement("div"));
			if (!json.length) {
				container.textContent = "No Results";
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
				fetch(`https://www.googleapis.com/customsearch/v1?cx=016332437324068616925:stn7bqajpbc&key=AIzaSyA7CUZ9Lr8l7NS761Y2XUiWMCBxo5rCraM&q=${artist}`)
				.then(response => response.json())
				.then(json => {
					image.src = json["items"][0]["pagemap"]["imageobject"][0]["url"];
				});

				item.appendChild(document.createTextNode(artist));
			});
		});
	});
});
