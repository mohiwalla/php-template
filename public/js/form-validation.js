/**
 * Validated input fields based upon schema defined and
 * submits the form the API route specified in action attribute of form.
 *
 * @param {SubmitEvent} e
 * @returns {void}
 *
 */
async function submitForm(e) {
    e.preventDefault()

    const form = e.target
    const submitBtn = form.querySelector("button[type='submit']")

    const formData = new FormData(form)
    const fieldset = form.parentElement
    const route = "/api" + form.getAttribute("action")

    setLoading(true, submitBtn)
    fieldset.disabled = true

    const req = await fetch(route, {
        method: "POST",
        body: formData,
    })

    fieldset.disabled = false
    setLoading(false, submitBtn)

    const res = await req.json()
    alert(res.text)
}

/**
 * Updates the loading state of the supplied button
 *
 * @param {boolean} state Loading state
 * @param {HTMLButtonElement} el A reference to the submit button
 */
function setLoading(state, el) {
    if (state) {
        el.append(loader())
    } else {
        const spinner = el.querySelector(".spinner-border")
        spinner?.remove()
    }
}

function loader() {
    const spinner = document.createElement("div")
    spinner.classList.add("spinner-border", "text-light")

    spinner.style.width = "20px"
    spinner.style.height = "20px"

    return spinner
}
