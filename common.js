class API {
	static getArtistSearch(artist) {
		return fetch(`API.php&a=${artist}`)
		.then(response => response.json());
	}
}
