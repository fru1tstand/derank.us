// Lobby linker

(function() {
	function joinLobbyClick() {
		document.getElementById('lobby-linker').src =
				"/getlink?lobbyid=" + this.parentElement.dataset.dbId;
	}

	function hideLobby() {
		document.getElementById('lobby-linker').src =
				"/hide?id=" + this.parentElement.dataset.dbId;
		this.parentElement.parentElement.removeChild(this.parentElement);
		checkNoLobbies();
	}

	function checkNoLobbies() {
		var noLobbies = document.getElementById('no-lobbies');
		var lobbies = document.getElementById('card-list');

		noLobbies.style.display = ((lobbies.children.length == 0) ? 'block' : 'none');
	}

	// Title linking
	var titleEls = document.querySelectorAll('#card-list .title');
	for (var i = 0; i < titleEls.length; i++) {
		titleEls[i].onclick = joinLobbyClick;
	}

	// Join button linking
	var joinEls = document.querySelectorAll('#card-list .join');
	for (var i = 0; i < joinEls.length; i++) {
		joinEls[i].onclick = joinLobbyClick;
	}

	var hideEls = document.querySelectorAll('#card-list .hide');
	for (var i = 0; i < hideEls.length; i++) {
		hideEls[i].onclick = hideLobby;
	}

	checkNoLobbies();
} ());
