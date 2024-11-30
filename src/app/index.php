<section class="my-20">
    <div class="container text-center grid gap-4">
        <h1 class="text-4xl font-extrabold md:text-5xl lg:text-6xl">Hey 👋, I am mohiwalla</h1>
        <p class="text-lg font-normal lg:text-xl text-muted-foreground">an underpaid sleepy full stack web developer</p>

        <div class="flex gap-4 justify-center mt-4">
            <a href="/about"
                class="btn-primary" title="Page is not created intentionally to demonstrate a 404 error page">
                Learn more
                <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>

            <a href="/contact"
                class="btn-secondary">
                <svg class="mr-2 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z">
                    </path>
                </svg>
                Contact
            </a>
        </div>
    </div>
</section>

<section class="mb-20">
    <div class="container">
        <div class="grid gap-8 lg:grid-cols-[2fr,1fr]">
            <div class="flex h-full items-center">
                <div>
                    <h2 class="text-3xl tracking-tight font-extrabold mb-4">This not my portfolio site</h2>

                    <div class="space-y-3">
                        <p class="sm:text-xl text-muted-foreground">
                            Its just a php template.. Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam totam voluptatum sit esse repellat neque, dolores laborum, velit excepturi error sint doloribus, quibusdam quam id in magnam ullam? Illum, tempora.
                        </p>
                    </div>
                </div>
            </div>

            <div class="hidden lg:block">
                <img src="/public/images/health.png" alt="" class="max-w-80 pointer-events-none" draggable="false">
            </div>
        </div>
    </div>
</section>

<section class="mb-20">
    <div class="container">
        <h2 class="text-4xl tracking-tight font-extrabold mb-4 text-center">Our mission</h2>

        <p class="sm:text-xl text-muted-foreground max-w-screen-lg mx-auto text-center">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos quasi deleniti ad odio, modi fugiat officiis ipsa, itaque, harum consequatur qui dolores atque. Dolorem, soluta.
        </p>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>