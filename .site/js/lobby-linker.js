// Lobby linker

(function() {
	function joinLobbyClick() {
		document.getElementById('lobby-linker').src =
				"/getlink?lobbyid=" + this.parentElement.dataset.dbId;
	}

	function hideLobby() {
		document.getElementById('lobby-linker').src =
				"/hide?id=" + this.parentElement.dataset.dbId;
		var cardContainer = this.parentElement.parentElement;
		cardContainer.removeChild(this.parentElement);
		if (cardContainer.children.length == 0) {
			cardContainer.innerHTML = "No active lobbies found. Consider making one!";
		}
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

	var hideEls = document.querySelectorAll('.card-list .hide');
	for (var i = 0; i < hideEls.length; i++) {
		hideEls[i].onclick = hideLobby;
	}

	window.thing = function() {
		alert("thing happened");
	}
} ());
