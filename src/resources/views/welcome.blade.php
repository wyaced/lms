<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calauan LMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="relative min-h-screen bg-white pt-20">
        <!-- Background Pattern -->
        <div class="absolute inset-0">
            <x-placeholder-pattern class="h-full w-full text-green-100" />
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 flex min-h-[calc(100vh-5rem)] flex-col items-center justify-center px-6 text-center">
            <h1 class="mb-6 text-4xl font-bold text-black md:text-6xl">
                Calauan LMS
            </h1>

            <p class="max-w-2xl text-lg text-gray-700 md:text-2xl">
                No student left behind. Life long learning for everyone.
            </p>

            <div class="my-8 h-1 w-32 rounded-full bg-green-600"></div>

            <div class="flex flex-col gap-4 sm:flex-row">
                <a href="/login"
                    class="rounded-lg bg-green-700 px-6 py-3 font-semibold text-white transition hover:bg-green-800">
                    Get Started
                </a>
                <a href="#solutions-section"
                    class="rounded-lg border border-green-700 px-6 py-3 font-semibold text-green-700 transition hover:bg-green-50">
                    Learn More
                </a>
            </div>
        </div>
    </div>
</body>

<x-navbar :navlinks="[
    ['url' => '#hero-section', 'text' => 'Home'],
    ['url' => '#solutions-section', 'text' => 'Features'],
    ['url' => '#contact-section', 'text' => 'Contact Us'],
]" />

<main>

    <section id = "goal-section"
        class="relative w-full h-screen bg-green-600 text-white flex flex-col items-center justify-center">
        <div class="absolute z-10 top-4 left-5 mb-10">
            <h2 class="text-4xl font-bold text-center ">Our vision and Goal</h2>
            <p class="text-lg text-white text-center mt-4 ">
                We envision a future where every student, regardless of their background or circumstances, has access to
                high-quality education and the opportunity to reach their full potential. Our goal is to create an
                inclusive and innovative learning environment that empowers students to thrive academically, socially,
                and emotionally.
            </p>
        </div>

        <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-35 h-90">
            <div
                class="bg-white text-slate-900 rounded-xl shadow-lg p-6 hover:scale-105 transition-transform duration-300">
                <h3 class="text-xl font-semibold mb-2">Article Title 1</h3>
                <p class="text-sm text-slate-600">
                    A short description
                </p>
            </div>

            <div
                class="bg-white text-slate-900 rounded-2xl shadow-lg p-6 hover:scale-105 transition-transform duration-300">
                <h3 class="text-xl font-semibold mb-2">Article Title 2</h3>
                <p class="text-sm text-slate-600">
                    A short description
                </p>
            </div>

            <div
                class="bg-white text-slate-900 rounded-2xl shadow-lg p-6 hover:scale-105 transition-transform duration-300">
                <h3 class="text-xl font-semibold mb-2">Article Title 3</h3>
                <p class="text-sm text-slate-600">
                    A short description
                </p>
            </div>
        </div>
    </section>

    <section id = "Features-sections">
        <div clas

    </section>


</main>

<footer id = "footer">
    <div class = "absolute bg-green-600 inset-0 min-h-screen -z-10">
    </div>

    <div class = "relative z-10 p-10 text-center text-black">
        <h3 class="text-2xl font-bold mb-10 text-black">Connect with Us</h3>
        <p class="text-black text-2xl">We’d love to hear your needs and goals!</p>
        <div class="flex justify-center">
            <p class="w-40 fmx-auto border-t-2 border-black/75 my-10"></p>
        </div>
    </div>

    </div>
</footer>

</body>

</html>
