// Lobby linker

(function() {
	function joinLobbyClick() {
		document.getElementById('lobby-linker').src =
				"/getlink?lobbyid=" + this.parentElement.dataset.dbId;
	}

	// Title linking
	var titleEls = document.querySelectorAll('.card-list .title');
	for (var i = 0; i < titleEls.length; i++) {
		titleEls[i].onclick = joinLobbyClick;
	}

	// Join button linking
	var joinEls = document.querySelectorAll('.card-list .join');
	for (var i = 0; i < joinEls.length; i++) {
		joinEls[i].onclick = joinLobbyClick;
	}

	window.thing = function() {
		alert("thing happened");
	}
} ());
