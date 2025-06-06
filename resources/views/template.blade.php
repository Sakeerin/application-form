@extends('layouts.app')

@section('title', 'Job Description')

@section('content')

    <body class="bg-gray-50 min-h-screen overflow-auto md:py-10">
        <div class="max-w-4xl mx-auto space-y-10">
            <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden mt-4">
                <!-- Header Image -->
                <div class="w-full h-48 md:h-64 bg-gray-200 relative">
                    <img src="../assets/Bangkok.jpg" alt="" class="w-full h-full object-cover object-center" />
                    <!-- Company Logo (overlaps header and main content) -->
                    <div class="absolute left-6 bottom-[-56px] md:bottom-[-72px] z-10">
                        <img src="../assets/logo_vby.png" alt="Company Logo"
                            class="w-32 h-32 md:w-40 md:h-40 rounded-xl bg-white border-4 border-white object-cover shadow-lg" />
                    </div>
                    <!-- Back Button -->
                    <button
                        class="absolute top-3 left-3 bg-white bg-opacity-80 hover:bg-opacity-100 transition px-2 py-1 rounded flex items-center text-sm font-medium text-gray-600 shadow">
                        <i class="fa-solid fa-angle-left"></i> &nbsp;
                        Back
                    </button>
                </div>
                <!-- Main Content -->
                <div class="p-6 md:p-8 pt-20 md:pt-24">
                    <div class="flex flex-col md:flex-row gap-8">
                        <!-- Main job details -->
                        <div class="flex-1 min-w-0">
                            <!-- Job Title & Info -->
                            <div class="flex flex-col-1 md:flex-row items-start md:items-center gap-6 md:gap-8">
                                <!-- Logo placeholder (for mobile spacing) -->
                                <div class="flex-1">
                                    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-2">
                                        <div>
                                            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">PHP Developer</h1>
                                            <div class="flex items-center gap-2 mt-2">
                                                <span
                                                    class="bg-purple-100 text-purple-700 px-2 py-0.5 rounded text-xs font-semibold">ONSITE</span>
                                                <span class="text-gray-500 text-sm font-semibold">Sathon, Bangkok</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Job Tags -->
                            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 gap-2 mt-6">
                                <div class="bg-gray-50 rounded p-3 text-center">
                                    <div class="flex justify-center items-center gap-2 text-sm font-bold text-gray-700">
                                        <i class="fa-solid fa-clock"></i>
                                        Full Time
                                    </div>
                                    <div class="mt-1 text-xs text-gray-500">9:00am - 6:00pm</div>
                                </div>
                                <div class="w-auto bg-gray-50 rounded p-3 text-center">
                                    <div class="flex justify-center items-center gap-2 text-sm font-bold text-gray-700">
                                        <i class="fa-solid fa-suitcase"></i>
                                        VBeyond
                                    </div>
                                    <div class="mt-1 text-xs text-gray-500">Information Technology Department</div>
                                </div>

                            </div>
                            <!-- Sidebar: แสดงเฉพาะมือถือ -->
                            <div class="block md:hidden">
                                <div class="w-full md:w-72 flex-shrink-0 mt-8 md:mt-0">
                                    <div class="space-y-4">
                                        <div class="flex flex-col gap-3">
                                            <button
                                                class="w-full bg-green-600 hover:bg-green-800 text-white font-bold py-2 rounded transition">Apply</button>
                                            <!-- Refer a Friend with Share Dropdown -->
                                            <div class="relative group w-full">
                                                <div x-data="{ open: false, hideTimeout: null }" class="relative w-full">
                                                    <button @mouseenter="clearTimeout(hideTimeout); open = true"
                                                        @mouseleave="hideTimeout = setTimeout(() => open = false, 200)"
                                                        @click="open = !open"
                                                        class="w-full bg-gray-900 hover:bg-gray-700 text-white font-bold py-2 rounded transition flex justify-center items-center gap-2"
                                                        type="button">
                                                        Share this Job
                                                    </button>
                                                    <div x-show="open" @mouseenter="clearTimeout(hideTimeout); open = true"
                                                        @mouseleave="hideTimeout = setTimeout(() => open = false, 200)"
                                                        class="absolute left-0 right-0 top-12 z-10 bg-white border rounded shadow-lg py-2 transition"
                                                        x-cloak>
                                                        <button
                                                            onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(window.location.href),'_blank')"
                                                            class="flex items-center w-full px-4 py-2 text-gray-700 hover:bg-gray-100 gap-2">
                                                            <i class="fa-brands fa-square-facebook"></i>
                                                            Share on Facebook
                                                        </button>
                                                        <button
                                                            onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&url='+encodeURIComponent(window.location.href),'_blank')"
                                                            class="flex items-center w-full px-4 py-2 text-gray-700 hover:bg-gray-100 gap-2">
                                                            <i class="fa-brands fa-linkedin"></i>
                                                            Share on LinkedIn
                                                        </button>
                                                        <button
                                                            onclick="window.location='mailto:?subject=Check this job&body='+encodeURIComponent(window.location.href)"
                                                            class="flex items-center w-full px-4 py-2 text-gray-700 hover:bg-gray-100 gap-2">
                                                            <i class="fa-solid fa-envelope"></i>
                                                            Share via Email
                                                        </button>
                                                        <button
                                                            onclick="navigator.clipboard.writeText(window.location.href)"
                                                            class="flex items-center w-full px-4 py-2 text-gray-700 hover:bg-gray-100 gap-2">
                                                            <i class="fa-solid fa-copy"></i>
                                                            Copy Link
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- Share Dropdown -->
                                                <div
                                                    class="absolute left-0 right-0 top-12 z-10 hidden group-hover:block bg-white border rounded shadow-lg py-2">
                                                    <button
                                                        onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(window.location.href),'_blank')"
                                                        class="flex items-center w-full px-4 py-2 text-gray-700 hover:bg-gray-100 gap-2">
                                                        <i class="fa-brands fa-square-facebook"></i>
                                                        Share on Facebook
                                                    </button>
                                                    <button
                                                        onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&url='+encodeURIComponent(window.location.href),'_blank')"
                                                        class="flex items-center w-full px-4 py-2 text-gray-700 hover:bg-gray-100 gap-2">
                                                        <i class="fa-brands fa-linkedin"></i>
                                                        Share on LinkedIn
                                                    </button>
                                                    <button
                                                        onclick="window.location='mailto:?subject=Check this job&body='+encodeURIComponent(window.location.href)"
                                                        class="flex items-center w-full px-4 py-2 text-gray-700 hover:bg-gray-100 gap-2">
                                                        <i class="fa-solid fa-envelope"></i>
                                                        Share via Email
                                                    </button>
                                                    <button onclick="navigator.clipboard.writeText(window.location.href)"
                                                        class="flex items-center w-full px-4 py-2 text-gray-700 hover:bg-gray-100 gap-2">
                                                        <i class="fa-solid fa-copy"></i>
                                                        Copy Link
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 mt-4 rounded p-4">
                                            <h3
                                                class="text-base font-bold text-gray-700 border-b-2 border-green-600 inline-block pb-1 mb-2">
                                                About us</h3>
                                            <p class="text-gray-700 text-sm">
                                                VBeyond Development Public Company Limited was established in 2010 to
                                                operate real
                                                estate development business, including housing projects and land in Chiang
                                                Mai, the
                                                North and all over the country. With expertise in real estate sales and
                                                marketing,
                                                in 2017, it expanded into real estate brokerage business for leading
                                                developers
                                                nationwide. Four subsidiaries were established to provide comprehensive
                                                services,
                                                including VB MANAGEMENT, BAAN INNOVATION, VBHOME SERVICE, PROPERTY MALL, and
                                                VBLAND.
                                                It also expanded its cooperation with business partners and expanded its
                                                branches
                                                both domestically and internationally, setting standards towards an
                                                international
                                                organization and developing sustainable businesses.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- The Role & Ideal Profile Section (vertical stack) -->
                            <div class="flex flex-col gap-8 mt-8">
                                <!-- The Role -->
                                <div>
                                    <h2
                                        class="text-lg font-bold text-gray-700 border-b-2 border-green-600 inline-block pb-1 mb-4">
                                        The Role</h2>
                                    <div>
                                        <p class="font-bold text-gray-700 mb-1">Job Description</p>
                                        <p class="text-gray-700 mb-4">
                                            We are looking for a PHP Developer responsible for managing back-end services
                                            and the
                                            interchange of data between the server and the users. Your primary focus will be
                                            the
                                            development of all server-side logic, definition and maintenance of the central
                                            database, and ensuring high performance and responsiveness to requests from the
                                            front-end. You will also be responsible for integrating the front-end elements
                                            built by
                                            your co-workers into the application. Therefore, a basic understanding of
                                            front-end
                                            technologies is necessary as well.
                                        </p>
                                        <p class="font-bold text-gray-700 mb-1">Responsibilities:</p>
                                        <ul class="list-disc ml-6 text-gray-700 space-y-2">
                                            <li>Integration of user-facing elements developed by front-end developers</li>
                                            <li>Build efficient, testable, and reusable PHP modules</li>
                                            <li>Solve complex performance problems and architectural challenges</li>
                                            <li>Integration of data storage solutions (may include databases, key-value
                                                stores, blob
                                                stores, etc.)</li>
                                            <li>Develop, test, and maintain <span class="font-semibold">PHP-based web
                                                    applications</span>.</li>
                                            <li>Write clean, well-structured, and maintainable <span
                                                    class="font-semibold">PHP
                                                    code</span>.</li>
                                            <li>Work with <span class="font-semibold">MySQL databases</span>, optimizing
                                                queries and
                                                database structures.</li>
                                            <li>Integrate third-party APIs and payment gateways.</li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Ideal Profile -->
                                <div>
                                    <h2
                                        class="text-lg font-bold text-gray-700 border-b-2 border-green-600 inline-block pb-1 mb-4">
                                        Ideal Profile</h2>
                                    <div>
                                        <p class="font-bold text-gray-700 mb-1">Skills and Qualifications</p>
                                        <ul class="list-disc ml-6 text-gray-700 space-y-2">
                                            <li>Proven experience as a PHP Developer (3+ years preferred).</li>
                                            <li>Strong knowledge of PHP, MySQL, HTML, CSS, JavaScript, and AJAX.</li>
                                            <li>Experience with PHP frameworks like Laravel, CodeIgniter, or Symfony.</li>
                                            <li>Understanding of RESTful APIs and integration.</li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- What's on Offer? -->
                                <div>
                                    <h2
                                        class="text-lg font-bold text-gray-700 border-b-2 border-green-600 inline-block pb-1 mb-4">
                                        What's on Offer?</h2>
                                    <div>
                                        <p class="font-bold text-gray-700 mb-1">Our Employee Welfare</p>
                                        <ul class="list-disc ml-6 text-gray-700 space-y-2">
                                            <li>Work within a company with a solid track record of success.</li>
                                            <li>Excellent career development opportunities</li>
                                            <li>Attractive salary & benefits</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar: แสดงเฉพาะ desktop -->
                        <div class="hidden md:block w-full md:w-72 flex-shrink-0 mt-8 md:mt-0">
                            <div class="space-y-4">
                                <div class="flex flex-col gap-3">
                                    <button
                                        class="w-full relative flex items-center justify-center font-bold py-2 h-10 rounded bg-green-600 text-white overflow-hidden group">
                                        <!-- View Job Text -->
                                        <span
                                            class="absolute transition-all duration-300 group-hover:translate-x-[-100%] group-hover:opacity-0">
                                            Apply
                                        </span>

                                        <!-- Arrow Icon -->
                                        <span
                                            class="absolute opacity-0 translate-x-full transition-all duration-300 group-hover:translate-x-0 group-hover:opacity-100">
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </span>
                                    </button>
                                    <!-- Refer a Friend with Share Dropdown -->
                                    <div class="relative group w-full">
                                        <div x-data="{ open: false, hideTimeout: null }" class="relative w-full">
                                            <button @mouseenter="clearTimeout(hideTimeout); open = true"
                                                @mouseleave="hideTimeout = setTimeout(() => open = false, 200)"
                                                @click="open = !open"
                                                class="w-full bg-gray-900 hover:bg-gray-700 text-white font-bold py-2 rounded transition flex justify-center items-center gap-2"
                                                type="button">
                                                Share this Job
                                            </button>
                                            <div x-show="open" @mouseenter="clearTimeout(hideTimeout); open = true"
                                                @mouseleave="hideTimeout = setTimeout(() => open = false, 200)"
                                                class="absolute left-0 right-0 top-12 z-10 bg-white border rounded shadow-lg py-2 transition"
                                                x-cloak>
                                                <button
                                                    onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(window.location.href),'_blank')"
                                                    class="flex items-center w-full px-4 py-2 text-gray-700 hover:bg-gray-100 gap-2">
                                                    <i class="fa-brands fa-square-facebook"></i>
                                                    Share on Facebook
                                                </button>
                                                <button
                                                    onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&url='+encodeURIComponent(window.location.href),'_blank')"
                                                    class="flex items-center w-full px-4 py-2 text-gray-700 hover:bg-gray-100 gap-2">
                                                    <i class="fa-brands fa-linkedin"></i>
                                                    Share on LinkedIn
                                                </button>
                                                <button
                                                    onclick="window.location='mailto:?subject=Check this job&body='+encodeURIComponent(window.location.href)"
                                                    class="flex items-center w-full px-4 py-2 text-gray-700 hover:bg-gray-100 gap-2">
                                                    <i class="fa-solid fa-envelope"></i>
                                                    Share via Email
                                                </button>
                                                <button onclick="navigator.clipboard.writeText(window.location.href)"
                                                    class="flex items-center w-full px-4 py-2 text-gray-700 hover:bg-gray-100 gap-2">
                                                    <i class="fa-solid fa-copy"></i>
                                                    Copy Link
                                                </button>
                                            </div>
                                        </div>
                                        <!-- Share Dropdown -->
                                        <div
                                            class="absolute left-0 right-0 top-12 z-10 hidden group-hover:block bg-white border rounded shadow-lg py-2">
                                            <button
                                                onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(window.location.href),'_blank')"
                                                class="flex items-center w-full px-4 py-2 text-gray-700 hover:bg-gray-100 gap-2">
                                                <i class="fa-brands fa-square-facebook"></i>
                                                Share on Facebook
                                            </button>
                                            <button
                                                onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&url='+encodeURIComponent(window.location.href),'_blank')"
                                                class="flex items-center w-full px-4 py-2 text-gray-700 hover:bg-gray-100 gap-2">
                                                <i class="fa-brands fa-linkedin"></i>
                                                Share on LinkedIn
                                            </button>
                                            <button
                                                onclick="window.location='mailto:?subject=Check this job&body='+encodeURIComponent(window.location.href)"
                                                class="flex items-center w-full px-4 py-2 text-gray-700 hover:bg-gray-100 gap-2">
                                                <i class="fa-solid fa-envelope"></i>
                                                Share via Email
                                            </button>
                                            <button onclick="navigator.clipboard.writeText(window.location.href)"
                                                class="flex items-center w-full px-4 py-2 text-gray-700 hover:bg-gray-100 gap-2">
                                                <i class="fa-solid fa-copy"></i>
                                                Copy Link
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 mt-4 rounded p-4">
                                    <h3
                                        class="text-base font-bold text-gray-700 border-b-2 border-green-600 inline-block pb-1 mb-2">
                                        About us</h3>
                                    <p class="text-gray-700 text-sm">
                                        VBeyond Development Public Company Limited was established in 2010 to operate real
                                        estate development business, including housing projects and land in Chiang Mai, the
                                        North and all over the country. With expertise in real estate sales and marketing,
                                        in 2017, it expanded into real estate brokerage business for leading developers
                                        nationwide. Four subsidiaries were established to provide comprehensive services,
                                        including VB MANAGEMENT, BAAN INNOVATION, VBHOME SERVICE, PROPERTY MALL, and VBLAND.
                                        It also expanded its cooperation with business partners and expanded its branches
                                        both domestically and internationally, setting standards towards an international
                                        organization and developing sustainable businesses.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection
