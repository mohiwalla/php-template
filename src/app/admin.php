<?php

if (@$_SESSION["email"]) {
    header("Location: /admin/dashboard");
}

?>

<div class="max-w-screen-sm w-full mx-auto my-8 px-5">
    <div class="grid gap-3 mb-4 text-center">
        <h2 class="sm:text-4xl text-3xl font-bold">Login to <?= name ?></h2>
    </div>

    <fieldset>
        <form onsubmit="login(event)" class="grid gap-4" id="form-fieldset">
            <div class="space-y-2 flex-grow">
                <label class="font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                    for="email">Email</label>
                <input class="custom" autocomplete="email" placeholder="Email address" name="email" required autofocus>
            </div>

            <div class="space-y-2 flex-grow">
                <label class="font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                    for="password">Password</label>
                <input class="custom" autocomplete="password" placeholder="*********" name="password" type="password"
                    required>
            </div>

            <button class="btn-primary" id="submit-btn">Login</button>
        </form>
    </fieldset>
</div>

<script>
    const fieldset = document.getElementById("form-fieldset")
    const submitBtn = document.getElementById("submit-btn")

    async function login(e) {
        e.preventDefault()

        const form = e.target
        const formData = new FormData(form)

        setLoading(true)
        form.closest("fieldset").disabled = true

        const req = await fetch("/api/login", {
            method: "post",
            body: formData
        })

        setLoading(false)
        form.closest("fieldset").disabled = false

        if (!req.ok) {
            return alert("Something went wrong. Please try again later.")
        }

        const res = await req.json()
        alert(res.text)

        if (res.ok) {
            location.assign("/admin/dashboard")
        }
    }
</script>
