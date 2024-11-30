<header class="sticky top-0 z-50 w-full border-b backdrop-blur">
    <nav>
        <div class="container flex flex-wrap items-center justify-between py-4">
            <a class="flex items-center" href="/"><span
                    class="select-none text-primary text-xl font-bold"><?= name ?></span></a>

            <div class="items-center justify-between hidden w-full md:flex md:w-auto">
                <ul class="flex flex-row gap-2">
                    <li>
                        <a href="/blogs" class="btn-ghost">
                            Blogs
                        </a>
                    </li>

                    <li>
                        <a href="/admin" class="btn-ghost">
                            Admin
                        </a>
                    </li>

                    <li>
                        <a href="http://github.com/mohiwalla/php-template" target="_blank" class="btn-ghost gap-2">
                            <i class="fa-brands fa-github"></i> GitHub
                        </a>
                    </li>
                </ul>
            </div>

            <a href="/contact" class="btn-primary">Contact</a>
        </div>
    </nav>
</header>