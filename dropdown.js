Array.from(document.querySelectorAll("input[type=\"search\"][name=\"a[]\"]")).forEach(input => {
	input.addEventListener("input", event => {
		fetch(`API.php?a=${input.value}`)
		.then(response => response.json())
		.then(json => {
			while (input.nextElementSibling)
				input.nextElementSibling.remove();

			let container = input.insertAdjacentElement("afterEnd", document.createElement("div"));
			json.forEach(artist => {
				let item = container.appendChild(document.createElement("div"));
				item.textContent = artist;
				item.addEventListener("click", event => {
					input.value = artist;
					container.remove();
				});
			});
		});
	});
});
