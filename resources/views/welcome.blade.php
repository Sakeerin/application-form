@extends('layouts.app')

@section('title', 'Join Us')

@section('content')

    <body class="bg-gray-50 min-h-screen overflow-auto md:py-10">
        <div class="max-w-4xl mx-auto space-y-10">
            <!-- Header -->
            <div
                class="bg-white rounded-xl md:rounded-t-xl rounded-t-none shadow-md p-4 md:p-8 grid grid-cols-3 gap-4 mt-0 md:mt-4">
                <!-- ส่วนซ้าย -->
                <div class="flex items-center min-w-0">
                    <span class="text-green-600 text-2xl md:text-3xl flex-shrink-0">
                        <i class="fa-solid fa-rocket"></i>
                    </span>
                </div>

                <div class="flex justify-center">
                    <h2 class="flex items-center text-base md:text-2xl font-medium text-center">
                        ร่วมงานกับเรา
                    </h2>
                </div>
                <!-- ส่วนขวา -->
                <div class="flex justify-end">
                    <img src="../assets/logo_vby.png" class="w-10 h-10 md:w-14 md:h-14" alt="logo_vby">
                </div>
            </div>

            <!-- Selector ทั้งหลาย -->
            <div class="bg-white rounded-xl shadow-md p-8 space-y-4 mt-8">
                <div class="max-w-6xl mx-auto">
                    <div class="flex flex-col items-center justify-center md:flex-row md:items-center md:gap-4">
                        <!-- Label -->
                        <label class="text-base font-semibold text-green-600 mb-2 md:mb-0 whitespace-nowrap">
                            ค้นหาตำแหน่งงาน :
                        </label>

                        <!-- Dropdown -->
                        <select name="position_selector"
                            class="w-full md:w-52 h-10 border border-gray-300 rounded-lg px-3 text-sm text-gray-600 bg-white focus:outline-none focus:ring-2 focus:ring-green-500 transition mb-2 md:mb-0">
                            <option value="">ทุกตำแหน่ง</option>
                            <option>Developer</option>
                            <option>Designer</option>
                            <option>Marketing</option>
                        </select>

                        <!-- Keyword -->
                        <input type="text" placeholder="คำสำคัญ" name="keyword"
                            class="w-full md:w-52 h-10 border border-gray-300 rounded-lg px-3 text-sm bg-white text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 transition mb-2 md:mb-0" />

                        <!-- Button -->
                        <button
                            class="h-8 px-3 text-sm md:h-10 md:px-4 md:text-base rounded-lg bg-green-600 hover:bg-green-700 text-white font-medium transition mb-2 md:mb-0">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <!-- Job Card -->
                <div
                    class="flex flex-col md:flex-row justify-between items-start md:items-center border p-4 rounded-lg shadow-sm bg-white">
                    <div>
                        <h3 class="text-base font-semibold text-gray-800">PHP Developer</h3>
                        <div class="flex flex-wrap items-center gap-2 mt-2 text-sm text-gray-600">
                            <span class="bg-black text-white px-2 py-1 rounded font-semibold">ONSITE</span>
                            <span class="border border-gray-300 px-2 py-1 rounded font-semibold">Sathon, Bangkok</span>
                            <span class="text-gray-500">VBeyond | Full Time</span>
                        </div>
                    </div>
                    <a href="/template-form"
                        class="relative flex items-center justify-center py-2 w-26 h-10 rounded bg-green-600 text-white overflow-hidden group text-sm font-medium">
                        <!-- View Job Text -->
                        <span
                            class="absolute transition-all duration-300 group-hover:translate-x-[-100%] group-hover:opacity-0">
                            ดูรายละเอียด
                        </span>

                        <!-- Arrow Icon -->
                        <span
                            class="absolute opacity-0 translate-x-full transition-all duration-300 group-hover:translate-x-0 group-hover:opacity-100">
                            <i class="fa-solid fa-arrow-right"></i>
                        </span>
                    </a>
                </div>

                <!-- Job Card -->
                <div
                    class="flex flex-col md:flex-row justify-between items-start md:items-center border p-4 rounded-lg shadow-sm bg-white">
                    <div>
                        <h3 class="text-base font-semibold text-gray-800">Server Administrator</h3>
                        <div class="flex flex-wrap items-center gap-2 mt-2 text-sm text-gray-600">
                            <span class="bg-black text-white px-2 py-1 rounded font-semibold">ONSITE</span>
                            <span class="border border-gray-300 px-2 py-1 rounded font-semibold">Sathon, Bangkok</span>
                            <span class="text-gray-500">VBeyond | Full Time</span>
                        </div>
                    </div>
                    <button
                        class="relative flex items-center justify-center py-2 w-26 h-10 rounded bg-green-600 text-white overflow-hidden group text-sm font-medium">
                        <!-- View Job Text -->
                        <span
                            class="absolute transition-all duration-300 group-hover:translate-x-[-100%] group-hover:opacity-0">
                            ดูรายละเอียด
                        </span>

                        <!-- Arrow Icon -->
                        <span
                            class="absolute opacity-0 translate-x-full transition-all duration-300 group-hover:translate-x-0 group-hover:opacity-100">
                            <i class="fa-solid fa-arrow-right"></i>
                        </span>
                    </button>
                </div>
                <!-- Job Card -->
                <div
                    class="flex flex-col md:flex-row justify-between items-start md:items-center border p-4 rounded-lg shadow-sm bg-white">
                    <div>
                        <h3 class="text-base font-semibold text-gray-800">Software Engineer</h3>
                        <div class="flex flex-wrap items-center gap-2 mt-2 text-sm text-gray-600">
                            <span class="bg-black text-white px-2 py-1 rounded font-semibold">ONSITE</span>
                            <span class="border border-gray-300 px-2 py-1 rounded font-semibold">Sathon, Bangkok</span>
                            <span class="text-gray-500">VBeyond | Full Time</span>
                        </div>
                    </div>
                    <button
                        class="relative flex items-center justify-center py-2 w-26 h-10 rounded bg-green-600 text-white overflow-hidden group text-sm font-medium">
                        <!-- View Job Text -->
                        <span
                            class="absolute transition-all duration-300 group-hover:translate-x-[-100%] group-hover:opacity-0">
                            ดูรายละเอียด
                        </span>

                        <!-- Arrow Icon -->
                        <span
                            class="absolute opacity-0 translate-x-full transition-all duration-300 group-hover:translate-x-0 group-hover:opacity-100">
                            <i class="fa-solid fa-arrow-right"></i>
                        </span>
                    </button>
                </div>

                <!-- Job Card -->
                <div
                    class="flex flex-col md:flex-row justify-between items-start md:items-center border p-4 rounded-lg shadow-sm bg-white">
                    <div>
                        <h3 class="text-base font-semibold text-gray-800">Trainee : IT</h3>
                        <div class="flex flex-wrap items-center gap-2 mt-2 text-sm text-gray-600">
                            <span class="bg-black text-white px-2 py-1 rounded font-semibold">ONSITE</span>
                            <span class="border border-gray-300 px-2 py-1 rounded font-semibold">Sathon, Bangkok</span>
                            <span class="text-gray-500">VBeyond | Full Time</span>
                        </div>
                    </div>
                    <button
                        class="relative flex items-center justify-center py-2 w-26 h-10 rounded bg-green-600 text-white overflow-hidden group text-sm font-medium">
                        <!-- View Job Text -->
                        <span
                            class="absolute transition-all duration-300 group-hover:translate-x-[-100%] group-hover:opacity-0">
                            ดูรายละเอียด
                        </span>

                        <!-- Arrow Icon -->
                        <span
                            class="absolute opacity-0 translate-x-full transition-all duration-300 group-hover:translate-x-0 group-hover:opacity-100">
                            <i class="fa-solid fa-arrow-right"></i>
                        </span>
                    </button>
                </div>

            </div>
        </div>
    </body>
@endsection
