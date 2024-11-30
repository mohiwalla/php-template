<div class="max-w-screen-sm w-full mx-auto my-6 px-5">
    <div class="grid gap-3 mb-4 text-center">
        <h2 class="sm:text-4xl text-3xl font-bold">Share your thoughts</h2>
        <p class="text-muted-foreground">Lorem ipsum dolor sit amet.!</p>
    </div>

    <form onsubmit="contact(event)">
        <fieldset class="grid gap-4">
            <div class="space-y-2 flex-grow">
                <label class="custom" for="name">Name</label>
                <input class="custom" placeholder="Your name..." autocomplete="name" name="name" autofocus required>
            </div>

            <div class="space-y-2 flex-grow">
                <label class="custom" for="email">Email</label>
                <input class="custom" autocomplete="email" type="email" placeholder="Email address" name="email"
                    required>
            </div>

            <div class="space-y-2 flex-grow">
                <label class="custom" for="phone">Phone</label>
                <input class="custom" autocomplete="phone" placeholder="Phone number" name="phone" required
                    inputmode="numeric">
            </div>

            <div class="space-y-2">
                <label class="custom" for="message">Message</label>
                <textarea class="custom max-h-40 min-h-24" placeholder="I want to discuss about..." name="message"
                    required minlength="10" maxlength="500"></textarea>
            </div>

            <button class="btn-primary">Send</button>
        </fieldset>
    </form>
</div>

<script>
    async function contact(e) {
        e.preventDefault()
        alert("It's just a dummy page bro.. 🙂")
    }
</script>