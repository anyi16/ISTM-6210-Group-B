
function jump(url) {
	if (!url || url == 'null' || url == null) {
		window.location.href = './index.html';
	}

	localStorage.setItem('iframeUrl', url.replace('../', './pages/'));
	window.location.href = url;
}


function back(num = -1) {
	window.history.go(num)
}


