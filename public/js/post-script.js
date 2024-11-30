const numericFields = document.querySelectorAll("[inputmode=numeric]")

numericFields.forEach((field) => {
	field.addEventListener("input", (e) => {
		const input = e.target
		const prefix = input.getAttribute("data-prefix") || ""
		input.value = prefix + input.value.replace(/[^0-9]/g, "")
	})
})
