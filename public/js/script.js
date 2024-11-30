function setStopClosing(state) {
	if (state) {
		window.addEventListener("beforeunload", stopClosing)
	} else {
		window.removeEventListener("beforeunload", stopClosing)
	}
}

function stopClosing(e) {
	e.preventDefault()
	return "warn"
}

function setLoading(state) {
	const loader = document.getElementById("global-loader")

	if (!loader) {
		return
	}

	if (state) {
		loader.classList.add("grid")
		loader.classList.remove("hidden")
		document.body.style.overflow = "hidden"
	} else {
		loader.classList.add("hidden")
		loader.classList.remove("grid")
		document.body.style.overflow = "auto"
	}
}
