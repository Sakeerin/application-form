@extends('layouts.app')

@section('title', 'Register')

@section('content')

    <body class="bg-gray-50 min-h-screen overflow-auto md:py-10">
        <div class="max-w-4xl mx-auto space-y-10">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">สำเร็จ! </strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Header -->
            <div
                class="bg-white rounded-xl md:rounded-t-xl rounded-t-none shadow-md p-4 md:p-8 grid grid-cols-3 gap-4 items-center mt-0 md:mt-4">
                <!-- ส่วนซ้าย -->
                <div class="flex items-center min-w-0">
                    <span class="text-green-600 text-2xl md:text-3xl flex-shrink-0">
                        <i class="fa-solid fa-file-lines"></i>
                    </span>
                </div>
                <div class="flex justify-center items-center text-center">
                    <h2 class="text-base md:text-2xl font-medium leading-snug">
                        ใบสมัครงาน <br> Application Form
                    </h2>
                </div>
                <!-- ส่วนขวา -->
                <div class="flex justify-end">
                    <img src="../assets/logo_vby.png" class="w-10 h-10 md:w-14 md:h-14" alt="logo_vby">
                </div>
            </div>

            <!-- Section: Profile & Basic Info -->
            <form autocomplete="off" action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Section: ใส่รูป ตำแหน่ง etc. -->
                <div class="grid md:grid-cols-3 gap-8 bg-white rounded-xl shadow-md p-8">
                    <!-- Profile Image -->
                    <div class="flex flex-col items-center justify-start col-span-1" x-data="{
                        previewUrl: '',
                        errorMsg: '',
                        isDragOver: false,
                        fileInput: null,
                        handleFiles(files) {
                            this.errorMsg = '';
                            if (!files?.length) return;
                            const file = files[0];
                            // ตรวจสอบประเภทไฟล์ด
                            if (!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
                                this.errorMsg = 'รองรับเฉพาะไฟล์ .jpg, .jpeg, .png เท่านั้น';
                                this.clear();
                                return;
                            }
                            // ตรวจสอบขนาดไฟล์ (5MB = 5 * 1024 * 1024)
                            if (file.size > 2 * 1024 * 1024) {
                                this.errorMsg = 'ไฟล์มีขนาดเกิน 2MB';
                                this.clear();
                                return;
                            }
                            // แสดงตัวอย่างรูป
                            const reader = new FileReader();
                            reader.onload = e => {
                                this.previewUrl = e.target.result;
                            };
                            reader.readAsDataURL(file);
                        },
                        onDrop(e) {
                            e.preventDefault();
                            const dt = e.dataTransfer;
                            const files = dt.files;
                            this.handleFiles(files);
                        },
                        triggerInput() {
                            this.$refs.fileInput.click();
                        },
                        clear() {
                            this.previewUrl = '';
                            this.$refs.fileInput.value = '';
                        }
                    }">
                        <div id="image-container"
                            :class="isDragOver ? 'border-green-700 border-4' : 'border-green-500 border-4'"
                            class="relative w-[200px] h-[200px] rounded-full border-dashed flex items-center justify-center bg-gray-100 hover:bg-green-100 transition mb-4"
                            @dragover.prevent="isDragOver = true" @dragenter.prevent="isDragOver = true"
                            @dragleave.prevent="isDragOver = false" @drop="onDrop($event)">
                            <input type="file" id="image1" name="img_user" accept=".jpg,.jpeg,.png" class="hidden"
                                x-ref="fileInput" @change="handleFiles($event.target.files)" />
                            <label for="image1"
                                class="cursor-pointer absolute inset-0 flex flex-col items-center justify-center">
                                <template x-if="!previewUrl">
                                    <div id="image-placeholder" class="flex flex-col items-center justify-center">
                                        <span class="text-gray-300 text-4xl"><i class="fa-regular fa-image"></i></span>
                                        <span class="text-xs text-gray-500">ลากหรือคลิก</span>
                                    </div>
                                </template>
                                <img x-show="previewUrl" :src="previewUrl" id="preview" name="imgUser"
                                    class="w-full h-full object-cover rounded-full" />
                            </label>
                        </div>
                        <span class="text-xs text-gray-400 text-center">รองรับ .jpg, .png, .jpeg</span>
                        <template x-if="errorMsg">
                            <div class="text-red-500 text-xs mt-2" x-text="errorMsg"></div>
                        </template>
                    </div>

                    <!-- Basic Info -->
                    <div class="md:col-span-2 grid grid-cols-1 gap-4 md:m-8">
                        <div>
                            <label for="position" class="block text-gray-700 font-semibold mb-1">ตำแหน่งที่สมัคร <span
                                    class="text-red-500">*</span></label>
                            <select name="position" id="position" required
                                class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                                <option value="">-- กรุณาเลือก --</option>
                                <option value="Chief Executive Officer">Chief Executive Officer</option>
                                <option value="Executive Assistant to the CEO">Executive Assistant to the CEO</option>
                                <option value="Assistant to the CEO">Assistant to the CEO</option>
                                <option value="Driver">Driver</option>
                                <option value="Agent Wealth International Manager">Agent Wealth International Manager</option>
                                <option value="Senior Secretary Manager">Senior Secretary Manager</option>
                                <option value="Secretary to the CEO Manager  Level 2">Secretary to the CEO Manager  Level 2</option>
                                <option value="Assistant Secretary to the CEO">Assistant Secretary to the CEO</option>
                                <option value="Internal Audit Manager">Internal Audit Manager</option>
                                <option value="Internal Audit Supervisor">Internal Audit Supervisor</option>
                                <option value="Internal Audit Officer">Internal Audit Officer</option>
                                <option value="Chief Operating Officer">Chief Operating Officer</option>
                                <option value="Senior Human Resource and Admin Manager">Senior Human Resource and Admin Manager</option>
                                <option value="Assistant Human Resource and Admin Manager ">Assistant Human Resource and Admin Manager </option>
                                <option value="Human Resource and Admin Supervisor">Human Resource and Admin Supervisor</option>
                                <option value="Recruitment Supervisor">Recruitment Supervisor</option>
                            </select>
                        </div>
                        <div x-data="fnSalary()">
                            <label for="salary" class="block text-gray-700 font-semibold mb-1">
                                เงินเดือนที่คาดหวัง <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="salary" name="salary" required inputmode="numeric"
                                class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50"
                                x-model="salary" @input="salary = formatNumber($event.target.value)">
                        </div>
                    </div>
                </div>
                <!-- Section: Required Documents (input file แบบ custom ปุ่ม upload) -->
                <div class="bg-white rounded-xl shadow-md p-8 space-y-6 mt-8">
                    <h2 class="text-lg font-bold text-green-600">
                        เอกสารประกอบการสมัครงาน
                    </h2>
                    <div class="grid md:grid-cols-3 grid-cols-2 gap-2 flex justify-between">

                        <!-- สำเนาทะเบียนบ้าน -->
                        <div x-init="fnDocuments($el)" class="flex flex-col items-center">
                            <label for="file_house"
                                class="cursor-pointer flex items-center pl-2 h-10 w-40 border border-gray-300 rounded hover:bg-green-50 transition"
                                title="อัปโหลดสำเนาทะเบียนบ้าน">
                                <i class="fa-solid fa-file-arrow-up text-green-600"></i>&nbsp;
                                <input type="file" class="hidden" id="file_house" name="file_house">
                                <span>สำเนาทะเบียนบ้าน</span>
                            </label>
                            <span class="text-xs font-bold text-blue-600 mt-1 hidden filename"></span>
                        </div>

                        <!-- สำเนาบัตรประชาชน -->
                        <div x-init="fnDocuments($el)" class="flex flex-col items-center">
                            <label for="file_id"
                                class="cursor-pointer flex items-center pl-2 h-10 w-40 border border-gray-300 rounded hover:bg-green-50 transition"
                                title="อัปโหลดสำเนาบัตรประชาชน">
                                <i class="fa-solid fa-file-arrow-up text-green-600"></i>&nbsp;
                                <input type="file" class="hidden" id="file_id" name="file_id">
                                <span>สำเนาบัตรประชาชน</span>
                            </label>
                            <span class="text-xs font-bold text-blue-600 mt-1 hidden filename"></span>
                        </div>

                        <!-- สำเนาวุฒิการศึกษา -->
                        <div x-init="fnDocuments($el)" class="flex flex-col items-center">
                            <label for="file_edu"
                                class="cursor-pointer flex items-center pl-2 h-10 w-40 border border-gray-300 rounded hover:bg-green-50 transition"
                                title="อัปโหลดสำเนาวุฒิการศึกษา">
                                <i class="fa-solid fa-file-arrow-up text-green-600"></i>&nbsp;
                                <input type="file" class="hidden" id="file_edu" name="file_edu">
                                <span>สำเนาวุฒิการศึกษา</span>
                            </label>
                            <span class="text-xs font-bold text-blue-600 mt-1 hidden filename"></span>
                        </div>

                        <!-- สำเนาใบผ่านงาน -->
                        <div x-init="fnDocuments($el)" class="flex flex-col items-center">
                            <label for="file_work"
                                class="cursor-pointer flex items-center pl-2 h-10 w-40 border border-gray-300 rounded hover:bg-green-50 transition"
                                title="อัปโหลดสำเนาใบผ่านงาน">
                                <i class="fa-solid fa-file-arrow-up text-green-600"></i>&nbsp;
                                <input type="file" class="hidden" id="file_work" name="file_work">
                                <span>สำเนาใบผ่านงาน</span>
                            </label>
                            <span class="text-xs font-bold text-blue-600 mt-1 hidden filename"></span>
                        </div>

                        <!-- สำเนาใบผ่านทหาร -->
                        <div x-init="fnDocuments($el)" class="flex flex-col items-center">
                            <label for="file_military"
                                class="cursor-pointer flex items-center pl-2 h-10 w-40 border border-gray-300 rounded hover:bg-green-50 transition"
                                title="อัปโหลดสำเนาใบผ่านทหาร">
                                <i class="fa-solid fa-file-arrow-up text-green-600"></i>&nbsp;
                                <input type="file" class="hidden" id="file_military" name="file_military">
                                <span>สำเนาใบผ่านทหาร</span>
                            </label>
                            <span class="text-xs font-bold text-blue-600 mt-1 hidden filename"></span>
                        </div>
                    </div>
                </div>

                <!-- Section: Personal Info -->
                <div class="bg-white rounded-xl shadow-md p-8 space-y-6 mt-8">
                    <h2 class="text-lg font-bold text-green-600">ข้อมูลส่วนตัว</h2>
                    <div class="grid md:justify-start">
                        <label class="block text-gray-700 font-semibold mb-1">คำนำหน้าชื่อ <span
                                class="text-red-500">*</span></label>
                        <div class="flex gap-4 grid grid-cols-3 items-center">
                            <div class="flex items-center gap-2">
                                <input type="radio" id="prefix-mr" name="prefix" value="นาย" required
                                    class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                <label for="prefix-mr">นาย / Mr.</label>
                            </div>
                            <div class="flex items-center gap-2">
                                <input type="radio" id="prefix-ms" name="prefix" value="นาง" required
                                    class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                <label for="prefix-ms">นาง / Ms.</label>
                            </div>
                            <div class="flex items-center gap-2">
                                <input type="radio" id="prefix-mrs" name="prefix" value="นางสาว" required
                                    class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                <label for="prefix-mrs">นางสาว / Mrs.</label>
                            </div>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- ชื่อภาษาไทย -->
                        <div x-data="{ value: '' }" x-init="fnNameInput($el)">
                            <label for="name_thai" class="block text-gray-700 font-semibold mb-1">
                                ชื่อ-นามสกุล (ไทย) <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name_thai" name="name_thai" data-lang="thai" x-model="value"
                                class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50"
                                placeholder="ชื่อ - นามสกุล ภาษาไทย" required>
                        </div>

                        <!-- ชื่อภาษาอังกฤษ -->
                        <div x-data="{ value: '' }" x-init="fnNameInput($el)">
                            <label for="name_eng" class="block text-gray-700 font-semibold mb-1">
                                ชื่อ-นามสกุล (อังกฤษ) <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name_eng" name="name_eng" data-lang="english" x-model="value"
                                class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50"
                                placeholder="ชื่อ - นามสกุล ภาษาอังกฤษ" required>
                        </div>

                        <!-- วันเดือนปีเกิด -->
                        <div class="flex items-center grid grid-cols-1 gap-4 items-center">
                            <div>
                                <label for="birthdate" class="block text-gray-700 font-semibold mb-1">วัน/เดือน/ปีเกิด
                                    <span class="text-red-500">*</span></label>
                                <input type="date" name="birthdate" id="birthdate" required
                                    class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                            </div>
                        </div>

                        <!-- เลขบัตรประชาชน -->
                        <div>
                            <label for="thai_id" class="block text-gray-700 font-semibold mb-1">
                                เลขที่บัตรประชาชน <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="thai_id" name="thai_id" required
                                class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50"
                                placeholder="X-XXXX-XXXXX-XX-X" maxlength="17" autocomplete="off"
                                oninput="formatThaiID(this)">
                        </div>
                    </div>
                    <div class="flex items-end grid md:grid-cols-3 gap-4 items-end "> <!-- Row 4 -->
                        <div>
                            <label for="nickname_thai" class="block text-gray-700 font-semibold mb-1">ชื่อเล่น
                                (ไทย)</label>
                            <input type="text" name="nickname_thai" id="nickname_thai"
                                class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                        </div>
                        <div>
                            <label for="height" class="block text-gray-700 font-semibold mb-1">ส่วนสูง (ซม.) </label>
                            <input type="number" name="height" id="height" min="10" max="300"
                                step="1"
                                class=" w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                        </div>
                        <div>
                            <label for="weight" class="block text-gray-700 font-semibold mb-1">น้ำหนัก (กก.) </label>
                            <input type="number" name="weight" id="weight" min="10" max="300"
                                step="1"
                                class=" w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                        </div>
                    </div>

                    <div class="flex items-end grid grid-cols-4 gap-6 items-end"> <!--Row 5 -->
                        <div>
                            <label for="age" class="block text-gray-700 font-semibold">อายุ (ปี) <span
                                    class="text-red-500">*</span></label>
                            <input type="number" name="age" id="age" readonly placeholder="--"
                                class="w-full h-10 border border-gray-300 rounded-lg px-3 bg-gray-200 text-gray-700">
                        </div>
                        <div>
                            <label for="nationality" class="block text-gray-700 font-semibold">สัญชาติ <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="nationality" id="nationality" required
                                class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                        </div>
                        <div>
                            <label for="ethnicity" class="block text-gray-700 font-semibold">เชื้อชาติ <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="ethnicity" id="ethnicity" required
                                class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                        </div>
                        <div>
                            <label for="bloodtype" class="block text-gray-700 font-semibold">หมู่โลหิต</label>
                            <select name="bloodtype" id="bloodtype"
                                class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                                <option value="" disabled selected>--</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                            </select>
                        </div>
                    </div>

                    <!-- สถานที่เกิดจ้า-->
                    <div class="flex items-end grid md:grid-cols-2 gap-6 items-end">
                        <div>
                            <label for="birthplace" class="block text-gray-700 font-semibold">สถานที่เกิด</label>
                            <input type="text" name="birthplace" id="birthplace"
                                class=" w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                        </div>
                    </div>
                    {{-- สถานภาพทางทหาร --}}
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">สถานภาพทางทหาร :</label>
                        <div class="flex gap-6 mb-2 md:justify-between">
                            <label class="flex items-center gap-2" for="military_pending">
                                <input type="radio" id="military_pending" name="militaryStatus" value="ยังไม่ได้รับการเกณฑ์ทหาร"
                                    class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                ยังไม่ได้รับการเกณฑ์ทหาร
                            </label>

                            <label class="flex items-center gap-2" for="military_done">
                                <input type="radio" id="military_done" name="militaryStatus" value="ผ่านการเกณฑ์ทหารแล้ว"
                                    class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                ผ่านการเกณฑ์ทหารแล้ว
                            </label>

                            <label class="flex items-center gap-2" for="military_serving">
                                <input type="radio" id="military_serving" name="militaryStatus" value="รับราชการทหารแล้ว"
                                    class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                รับราชการทหารแล้ว
                            </label>

                            <label class="flex items-center gap-2" for="military_exempted">
                                <input type="radio" id="military_exempted" name="militaryStatus" value="ได้รับการยกเว้น"
                                    class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                ได้รับการยกเว้น
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Section: Personal Family Info and Status ประวัติครอบครัวและสถานะ -->
                <div class="bg-white rounded-xl shadow-md p-8 space-y-6 mt-8">
                    <h2 class="text-lg font-bold text-green-600">ข้อมูลครอบครัว</h2>
                    <div class="flex items-center gap-4 grid md:grid-cols-[20%_80%]">
                        <!-- Row 1 -->
                        <label class="block text-gray-700 font-semibold mb-1">สถานภาพทางสมรส :</label>
                        <div class="flex gap-4">
                            <label class="flex items-center gap-2"><input type="radio" id="single" name="status" value="โสด"
                                    class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                โสด</label>
                            <label class="flex items-center gap-2"><input type="radio" id="married" name="status" value="สมรส"
                                    class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                สมรส</label>
                            <label class="flex items-center gap-2"><input type="radio" id="widowed" name="status" value="หม้าย"
                                    class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                หม้าย</label>
                            <label class="flex items-center gap-2"><input type="radio" id="divorced" name="status" value="หย่าร้าง"
                                    class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                หย่าร้าง</label>
                        </div>
                        <!-- Section: ท่านมีบุตรหรือไม่ -->
                        <label class="block text-gray-700 font-semibold mb-1">ท่านมีบุตรหรือไม่ :</label>
                        <div x-data="fnHasChildren()" class="mb-2">

                            <div class="flex gap-4">
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="hasChildren" value="มี" x-model="hasChildren"
                                        class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                    มี
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="hasChildren" value="ไม่มี" x-model="hasChildren"
                                        class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                    ไม่มี
                                </label>
                            </div>

                            <!-- ช่องใส่จำนวนบุตร -->
                            <div x-show="hasChildren === 'มี'" x-transition class="mt-2">
                                <input type="number" name="children_count" id="children_count" min="1"
                                    class="w-40 h-10 border border-gray-300 rounded-lg px-3 bg-gray-50 focus:ring-2 focus:ring-green-400"
                                    placeholder="ระบุจำนวนบุตร">
                            </div>
                        </div>

                    </div>

                    <div>
                        <div class="flex items-center grid md:grid-cols-[400px_3fr_2fr] gap-6 items-end">
                            <!-- ข้อมูลพ่อ-แม่ -->
                            <!-- ชื่อ-นามสกุล บิดา -->
                            <div>
                                <label for="dadname" class="block text-gray-700 font-semibold">ชื่อ-นามสกุล บิดา</label>
                                <input type="text" name="dadname" id="dadname"
                                    class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                            </div>
                            <!-- อาชีพ บิดา -->
                            <div>
                                <label for="dadjob" class="block text-gray-700 font-semibold">อาชีพ บิดา</label>
                                <input type="text" name="dadjob" id="dadjob"
                                    class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                            </div>
                            <!-- Radio Group (แนวตั้ง) -->
                            <fieldset class="flex flex-col gap-y-2 mt-2 md:mt-0">
                                <legend class="text-sm font-semibold text-gray-900 mb-1">สถานะของบิดา</legend>
                                
                                <label for="dad_alive" class="flex items-center gap-2">
                                    <input type="radio" id="dad_alive" name="dadalive" value="มีชีวิตอยู่"
                                        class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                    <span class="text-gray-700 font-medium">มีชีวิตอยู่</span>
                                </label>
                                
                                <label for="dad_deceased" class="flex items-center gap-2">
                                    <input type="radio" id="dad_deceased" name="dadalive" value="ถึงแก่กรรม"
                                        class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                    <span class="text-gray-700 font-medium">ถึงแก่กรรม</span>
                                </label>
                            </fieldset>

                            <!-- ชื่อ-นามสกุล มารดา -->
                            <div>
                                <label for="momname" class="block text-gray-700 font-semibold">ชื่อ-นามสกุล มารดา</label>
                                <input type="text" name="momname" id="momname"
                                    class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                            </div>
                            <!-- อาชีพ มารดา -->
                            <div>
                                <label for="momjob" class="block text-gray-700 font-semibold">อาชีพ มารดา</label>
                                <input type="text" name="momjob" id="momjob"
                                    class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                            </div>
                            <!-- Radio Group (แนวตั้ง) -->
                            <fieldset class="flex flex-col gap-y-2 mt-2 md:mt-0">
                                <legend class="text-sm font-semibold text-gray-900 mb-1">สถานะของมารดา</legend>

                                <label for="mom_alive" class="flex items-center gap-2">
                                    <input type="radio" id="mom_alive" name="momalive" value="มีชีวิตอยู่"
                                        class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                    <span class="text-gray-700 font-medium">มีชีวิตอยู่</span>
                                </label>

                                <label for="mom_deceased" class="flex items-center gap-2">
                                    <input type="radio" id="mom_deceased" name="momalive" value="ถึงแก่กรรม"
                                        class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                    <span class="text-gray-700 font-medium">ถึงแก่กรรม</span>
                                </label>
                            </fieldset>

                            <!-- ชื่อ-นามสกุล คู่สมรส -->
                            <div>
                                <label for="spounsename" class="block text-gray-700 font-semibold">ชื่อ-นามสกุล
                                    คู่สมรส</label>
                                <input type="text" name="spounsename" id="spounsename"
                                    class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                            </div>
                            {{-- อาชีพ --}}
                            <div>
                                <label for="spounse_career" class="block text-gray-700 font-semibold">อาชีพ
                                    คู่สมรส</label>
                                <input type="text" name="spounse_career" id="spounse_career"
                                    class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section: Address & Contact ที่อยู่และช่องทางการติดต่อ-->
                <div class="bg-white rounded-xl shadow-md p-8 space-y-6 mt-8">
                    <h2 class="text-lg font-bold text-green-600">ที่อยู่ตามทะเบียนบ้าน</h2>
                    <!-- ครอบทั้งหมดด้วย Alpine -->
                    <div x-data="addressUser()" x-init="init()">
                        <!-- Section: ที่อยู่ตามทะเบียนบ้าน -->
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="address" class="block text-gray-700 font-semibold mb-1">ที่อยู่ตามทะเบียนบ้าน
                                    <span class="text-red-500">*</span></label>
                                <input type="text" id="address" x-model="registered.address" name="address" required
                                    class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50"
                                    placeholder="เลขที่/หมู่บ้าน/ซอย/ถนน">
                            </div>
                            <div>
                                <label for="province" class="block text-gray-700 font-semibold mb-1">จังหวัด <span
                                        class="text-red-500">*</span></label>
                               <select x-model="selectedProvince" @change="loadAmphoes" name="province" class="w-full border rounded-lg px-3 h-10">
                                    <option value="">กรุณาเลือกจังหวัด</option>
                                    <template x-for="p in provinces" :key="p.province_id">
                                        <option :value="p.province" x-text="p.province"></option>
                                    </template>
                                </select>
                            </div>
                            <div>
                                <label for="district" class="block text-gray-700 font-semibold mb-1">อำเภอ/เขต <span
                                        class="text-red-500">*</span></label>
                                <select x-model="selectedAmphoe" @change="loadTambons" name="district" class="w-full border rounded-lg px-3 h-10">
                                    <option value="">กรุณาเลือกอำเภอ</option>
                                    <template x-for="a in amphoes" :key="a.amphoe_id">
                                        <option :value="a.amphoe" x-text="a.amphoe"></option>
                                    </template>
                                </select>
                            </div>
                            <div>
                                <label for="subdistrict" class="block text-gray-700 font-semibold mb-1">ตำบล/แขวง <span
                                        class="text-red-500">*</span></label>
                                <select x-model="selectedTambon" @change="loadZipcode" name="subdistrict" class="w-full border rounded-lg px-3 h-10">
                                    <option value="">กรุณาเลือกตำบล</option>
                                    <template x-for="t in tambons" :key="t.tambon_id">
                                        <option :value="t.tambon" x-text="t.tambon"></option>
                                    </template>
                                </select>
                            </div>
                            <div>
                                <label for="postcode" class="block text-gray-700 font-semibold mb-1">รหัสไปรษณีย์ <span
                                        class="text-red-500">*</span></label>
                                <input type="text" x-model="registered.postcode" name="postcode" readonly class="w-full border rounded-lg px-3 h-10 bg-gray-100"
                                    placeholder="รหัสไปรษณีย์" />
                            </div>
                        </div>

                        <!-- Section: ที่อยู่ปัจจุบัน -->
                        <div class="space-y-6 mt-8">
                            <h2 class="text-lg font-bold text-green-600">ที่อยู่ปัจจุบัน</h2>

                            <label class="flex items-center space-x-2">
                                <input type="checkbox" x-model="sameAsRegistered" class="accent-green-600 w-4 h-4">
                                <span class="text-gray-700">ใช้ที่อยู่ตามทะเบียนบ้าน</span>
                            </label>

                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Show when sameAsRegistered is true -->
                                <div x-show="sameAsRegistered">
                                    <label for="curr_address" class="block text-gray-700 font-semibold mb-1">
                                        ที่อยู่ปัจจุบัน <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="curr_address" x-model="current.address" name="curr_address"
                                        :readonly="sameAsRegistered"
                                        class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50"
                                        placeholder="เลขที่/หมู่บ้าน/ซอย/ถนน">
                                </div>

                                <!-- Show when sameAsRegistered is false -->
                                <div x-show="!sameAsRegistered">
                                    <label for="curr_address" class="block text-gray-700 font-semibold mb-1">
                                        ที่อยู่ปัจจุบัน <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="curr_address" x-model="current.address" name="curr_address"
                                        class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50"
                                        placeholder="เลขที่/หมู่บ้าน/ซอย">
                                </div>
                                <div x-show="sameAsRegistered">
                                    <label for="curr_province" class="block text-gray-700 font-semibold mb-1">จังหวัด
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="curr_province" x-model="current.province" name="curr_province" 
                                        :readonly="sameAsRegistered"
                                        class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                                </div>
                                <div x-show="!sameAsRegistered">
                                    <label for="curr_province" class="block text-gray-700 font-semibold mb-1">จังหวัด
                                        <span class="text-red-500">*</span></label>
                                    <input type="hidden" name="select_province" x-model="current.province">
                                    <select x-model="selectedSecondProvince" @change="loadAmphoesCurr" name="curr_province" class="w-full border rounded-lg px-3 h-10">
                                    <option value="">กรุณาเลือกจังหวัด</option>
                                        <template x-for="p in provinces_curr" :key="p.province_id">
                                            <option :value="p.province" x-text="p.province"></option>
                                        </template>
                                    </select>
                                </div>
                                <div x-show="sameAsRegistered">
                                    <label for="curr_district" class="block text-gray-700 font-semibold mb-1">อำเภอ/เขต
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="curr_district" x-model="current.district" name="curr_district"
                                        :readonly="sameAsRegistered"
                                        class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                                </div>
                                <div x-show="!sameAsRegistered">
                                    <label for="curr_district" class="block text-gray-700 font-semibold mb-1">อำเภอ/เขต
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="hidden" name="select_district" x-model="current.district">
                                    <select x-model="selectedSecondAmphoe" @change="loadTambonsCurr" name="curr_district" class="w-full border rounded-lg px-3 h-10">
                                        <option value="">กรุณาเลือกอำเภอ</option>
                                        <template x-for="a in amphoes_curr" :key="a.amphoe_id">
                                            <option :value="a.amphoe" x-text="a.amphoe"></option>
                                        </template>
                                    </select>
                                </div>
                                <div x-show="sameAsRegistered">
                                    <label for="curr_subdistrict" class="block text-gray-700 font-semibold mb-1">ตำบล/แขวง
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="curr_subdistrict" x-model="current.subdistrict" name="curr_subdistrict"
                                        :readonly="sameAsRegistered"
                                        class="w-full h-10 border border-gray-300 rounded-lg px-3 bg-gray-50">
                                </div>
                                <div x-show="!sameAsRegistered">
                                    <label for="curr_subdistrict" class="block text-gray-700 font-semibold mb-1">ตำบล/แขวง
                                        <span class="text-red-500">*</span></label>
                                    <input type="hidden" name="select_subdistrict" x-model="current.subdistrict">
                                    <select x-model="selectedSecondTambon" @change="loadZipcodeCurr" name="curr_subdistrict" class="w-full border rounded-lg px-3 h-10">
                                        <option value="">กรุณาเลือกตำบล</option>
                                        <template x-for="t in tambons_curr" :key="t.tambon_id">
                                            <option :value="t.tambon" x-text="t.tambon"></option>
                                        </template>
                                    </select>
                                </div>
                                <div x-show="sameAsRegistered">
                                    <label for="curr_postcode" class="block text-gray-700 font-semibold mb-1">รหัสไปรษณีย์
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="curr_postcode" x-model="current.postcode" name="curr_postcode"
                                        :readonly="sameAsRegistered"
                                        class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                                </div>
                                <div x-show="!sameAsRegistered">
                                    <label for="curr_postcode" class="block text-gray-700 font-semibold mb-1">รหัสไปรษณีย์
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" x-model="current.postcode" name="curr_postcode" readonly class="w-full border rounded-lg px-3 h-10 bg-gray-100"
                                    placeholder="รหัสไปรษณีย์" />
                                </div>
                            </div>

                            <div class="space-y-6 mt-8">
                                <h2 class="text-lg font-bold text-green-600">ช่องทางการติดต่อ</h2>
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div x-data="phoneFormat" class="w-full">
                                        <label for="phone_mobile" class="block text-gray-700 font-semibold mb-1">
                                            เบอร์โทรศัพท์ <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="phone_mobile" name="phone_mobile" x-model="phone"
                                            @input="phone = formatPhone(phone)" maxlength="12" inputmode="numeric"
                                            pattern="\d{3}-\d{3}-\d{4}" required
                                            class="w-full h-10 border border-gray-300 rounded-lg px-3 bg-gray-50 focus:ring-2 focus:ring-green-400">
                                    </div>

                                    <div>
                                        <label for="email" class="block text-gray-700 font-semibold mb-1">E-mail <span
                                                class="text-red-500">*</span></label>
                                        <input type="email" name="email" id="email" required
                                            placeholder="someone@example.com"
                                            class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                                    </div>
                                    <div>
                                        <label for="facebook"
                                            class="block text-gray-700 font-semibold mb-1">Facebook</label>
                                        <input type="text" id="facebook" name="facebook"
                                            class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                                    </div>
                                    <div>
                                        <label for="line_id" class="block text-gray-700 font-semibold mb-1">Line
                                            ID</label>
                                        <input type="text" id="line_id" name="line_id"
                                            class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section: ประวัติการศึกษา -->
                <div class="bg-white rounded-xl shadow-md p-8 mt-8" x-data="educationHandler()">
                    <input type="hidden" name="educations" :value="JSON.stringify(educations)">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-lg font-bold text-green-600">ประวัติการศึกษา</h2>
                        <button type="button"
                            class="bg-green-500 hover:bg-green-700 text-white px-4 py-1 rounded-full flex items-center gap-1 text-sm"
                            @click="addRow()">
                            <i class="fa-solid fa-plus"></i> เพิ่มข้อมูล
                        </button>
                    </div>

                    <p class="text-xs text-gray-500 mt-2 ml-1">
                        <span class="text-red-500">* </span>เรียงจากใหม่ไปเก่าสุด
                    </p>

                    <div class="space-y-4">
                        <template x-for="(edu, idx) in educations" :key="idx">
                            <div class="pt-4 grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-4"
                                :class="idx !== 0 ? 'border-t border-gray-500 pt-8 mt-4' : ''">
                                <!-- ระดับการศึกษา -->
                                <div>
                                    <label for="edu_level"
                                        class="block text-sm font-medium text-gray-700 mb-1">ระดับการศึกษา
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <select name="edu_level" id="edu_level"
                                        class="w-full border focus:ring-2 focus:ring-green-400 rounded-lg px-2 py-1 h-10 bg-gray-50"
                                        x-model="edu.level" required>
                                        <option value="" disabled selected>เลือกระดับ</option>
                                        <option value="ปริญญาเอก">ปริญญาเอก</option>
                                        <option value="ปริญญาโท">ปริญญาโท</option>
                                        <option value="ปริญญาตรี">ปริญญาตรี</option>
                                        <option value="อนุปริญญา">อนุปริญญา</option>
                                        <option value="ปวส.">ปวส.</option>
                                        <option value="ปวช.">ปวช.</option>
                                        <option value="มัธยมศึกษา">มัธยมศึกษา</option>
                                    </select>
                                </div>

                                <!-- ชื่อสถานศึกษา -->
                                <div class="col-span-1 sm:col-span-2 lg:col-span-2">
                                    <label for="edu_name"
                                        class="block text-sm font-medium text-gray-700 mb-1">ชื่อสถานศึกษา
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="edu_name" id="edu_name"
                                        class="w-full border focus:ring-2 focus:ring-green-400 rounded-lg h-10 px-2 py-1 bg-gray-50"
                                        x-model="edu.school" required>
                                </div>

                                {{-- <div class="col-span-1 sm:col-span-2 lg:col-span-2 relative" x-data="universityAutocomplete()"
                                    x-init="loadUniversities()">
                                    <label for="edu_name"
                                        class="block text-sm font-medium text-gray-700 mb-1">ชื่อสถานศึกษา</label>

                                    <input type="text" name="edu_name" id="edu_name"
                                        class="w-full border focus:ring-2 focus:ring-green-400 rounded-lg h-10 px-2 py-1 bg-gray-50"
                                        x-model="query" @input="filterUniversities" @focus="show = true"
                                        @click.away="show = false" autocomplete="off">

                                    <!-- กล่องแสดงคำแนะนำ -->
                                    <ul x-show="show && filtered.length > 0"
                                        class="absolute z-10 w-full bg-white border border-gray-300 rounded mt-1 max-h-60 overflow-y-auto shadow">
                                        <template x-for="name in filtered" :key="name">
                                            <li class="px-3 py-2 hover:bg-green-100 cursor-pointer text-sm"
                                                @click="selectUniversity(name)" x-text="name"></li>
                                        </template>
                                    </ul>
                                </div> --}}


                                <!-- ประเทศ -->
                                <div>
                                    <label for="edu_country"
                                        class="block text-sm font-medium text-gray-700 mb-1">ประเทศ
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="edu_country" id="edu_country"
                                        class="w-full border focus:ring-2 focus:ring-green-400 rounded-lg h-10 px-2 py-1 bg-gray-50"
                                        x-model="edu.country" required>
                                </div>

                                <!-- หลักสูตร -->
                                <div>
                                    <label for="edu_program"
                                        class="block text-sm font-medium text-gray-700 mb-1">หลักสูตร/ชื่อปริญญา
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="edu_program" id="edu_program"
                                        class="w-full border focus:ring-2 focus:ring-green-400 rounded-lg h-10 px-2 py-1 bg-gray-50"
                                        x-model="edu.program" required>
                                </div>

                                <!-- สาขาวิชา -->
                                <div>
                                    <label for="edu_major"
                                        class="block text-sm font-medium text-gray-700 mb-1">สาขาวิชา
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="edu_major" id="edu_major"
                                        class="w-full border focus:ring-2 focus:ring-green-400 rounded-lg h-10 px-2 py-1 bg-gray-50"
                                        x-model="edu.major" required>
                                </div>

                                <!-- เกรดเฉลี่ย -->
                                <div x-data="formatGPA()">
                                    <label for="edu_gpx"
                                        class="block text-sm font-medium text-gray-700 mb-1">เกรดเฉลี่ย
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="edu_gpx" id="edu_gpx"
                                        class="w-full border focus:ring-2 focus:ring-green-400 rounded-lg h-10 px-2 py-1 bg-gray-50"
                                        x-model="edu.gpa" @blur="edu.gpa = formatGPA(edu.gpa)" inputmode="decimal"
                                        maxlength="4" required>
                                </div>


                                <!-- ปีที่จบ -->
                                <div>
                                    <label for="edu_gradyear"
                                        class="block text-sm font-medium text-gray-700 mb-1">ปีที่สำเร็จการศึกษา
                                        <span class="text-red-500">*</span>
                                    </label>
                                         <input type="number"
                                            name="edu_gradyear"
                                            id="edu_gradyear"
                                            class="w-full border focus:ring-2 focus:ring-green-400 rounded-lg h-10 px-2 py-1 bg-gray-50"
                                            x-model="edu.graduate_year"
                                            inputmode="numeric"
                                            @input="edu.graduate_year = edu.graduate_year.toString().slice(0, 4)"
                                            required>
                                    {{-- <input type="number" name="edu_gradyear" id="edu_gradyear"
                                        class="w-full border focus:ring-2 focus:ring-green-400 rounded-lg h-10 px-2 py-1 bg-gray-50"
                                        x-model="edu.graduate_year" inputmode="number" maxlength="4" required> --}}
                                </div>

                                <!-- ปุ่มลบ -->
                                <div class="flex sm:items-end sm:justify-end pt-6">
                                    <button type="button" class="text-red-500 font-bold py-2 px-2"
                                        @click="removeRow(idx)" :disabled="educations.length === 1"
                                        :class="educations.length === 1 ? 'opacity-40 cursor-not-allowed' : ''"
                                        title="ลบรายการนี้">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Section: Talent ความสามารถ ก้อนนี้ลองใช้ Alpine.js เขียนด้วย-->
                <div class="bg-white rounded-xl shadow-md p-8 space-y-6 mt-8">
                    <h2 class="text-lg font-bold text-green-600">ความสามารถ</h2>
                    <div class="flex items-center grid md:grid-cols-[100%]">

                        <!-- Row 1 ความสามารถในการขับขี่ -->
                        <div x-data="{ car: false, motorcycle: false }" class="bg-gray-50 p-4 rounded-lg mb-4">
                            <label class="block text-gray-700 font-semibold mb-4">ความสามารถในการขับขี่ยานยานพาหนะ</label>

                            <div class="flex flex-col sm:flex-row sm:gap-x-4 md:gap-x-6">
                                <!-- ใบขับขี่รถยนต์ -->
                                <div class="space-y-2" x-data="{ car: false }">
                                    <label for="carlicense" class="inline-flex items-center gap-2">
                                        <input type="checkbox" name="has_car_license" id="carlicense"
                                            class="accent-green-600 w-4 h-4" x-model="car">
                                        <span>มีใบขับขี่รถยนต์</span>
                                    </label>

                                    <div x-show="car" x-transition>
                                        <input type="text" name="car_license_number" id="car_license_number"
                                            placeholder="เลขที่ใบขับขี่รถยนต์"
                                            class="w-52 sm:w-40 border border-gray-300 focus:ring-2 focus:ring-green-400 rounded px-3 py-1 bg-gray-50 mb-4" />
                                    </div>
                                </div>
                                <!-- ใบขับขี่รถจักรยานยนต์ -->
                                <div class="space-y-2">
                                    <label class="inline-flex items-center gap-2">
                                        <input type="checkbox" name="has_motor_license" id="motorlicense"
                                            class="accent-green-600 w-4 h-4" x-model="motorcycle">
                                        <span>มีใบขับขี่รถจักรยานยนต์</span>
                                    </label>
                                    <div x-show="motorcycle" x-transition>
                                        <input type="text" name="motor_license_number" id="motor_license_number"
                                            placeholder="เลขที่ใบขับขี่รถจักรยานยนต์"
                                            class="w-52 sm:w-40 border border-gray-300 focus:ring-2 focus:ring-green-400 rounded px-3 py-1 bg-gray-50 mb-4" />
                                    </div>
                                </div>
                            </div>

                            <!-- คำถามเกี่ยวกับการเดินทางไปทำงานต่างจังหวัด -->
                            <div x-data="{ travel: '' }">
                                <label for="travel_yes" class="block text-gray-700 font-semibold mt-4 mb-4">
                                    ท่านสะดวกที่จะเดินทางไปปฏิบัติงานต่างจังหวัดหรือไม่
                                </label>

                                <div class="grid-cols-3 items-center flex gap-x-8">
                                    <label for="travel_yes" class="inline-flex items-center gap-2 md:mr-20">
                                        <input type="radio" name="travel" id="travel_yes" value="สะดวก"
                                            class="accent-green-600 w-4 h-4" x-model="travel">
                                        <span>สะดวก</span>
                                    </label>

                                    <label for="travel_no" class="inline-flex items-center gap-2 md:mr-20">
                                        <input type="radio" name="travel" id="travel_no" value="ไม่สะดวก"
                                            class="accent-green-600 w-4 h-4" x-model="travel">
                                        <span>ไม่สะดวก</span>
                                    </label>

                                    <label for="travel_sometimes" class="inline-flex items-center gap-2">
                                        <input type="radio" name="travel" id="travel_sometimes" value="บางครั้ง"
                                            class="accent-green-600 w-4 h-4" x-model="travel">
                                        <span>บางครั้ง</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Row 2 ความสามารถด้านคอมพิวเตอร์ -->
                        <div x-data="fnComputerSkills()" class="bg-gray-50 p-4 rounded-lg mb-4">
                            <input type="hidden" name="programs" :value="JSON.stringify(programs)">
                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-gray-700 font-semibold mb-2 mt-6">
                                    ความสามารถด้านคอมพิวเตอร์
                                </label>
                                <button type="button"
                                    class="bg-green-500 hover:bg-green-700 text-white px-4 py-1 rounded-full flex items-center gap-1 text-sm mt-2"
                                    @click="addProgram()">
                                    <i class="fa-solid fa-plus"></i> เพิ่มข้อมูล
                                </button>
                            </div>

                            <template x-for="(program, idx) in programs" :key="idx">
                                <div class="grid grid-cols-1 md:grid-cols-[2fr_auto_auto] gap-6 mb-2">
                                    <!-- โปรแกรม -->
                                    <input type="text" name="program_name" x-model="program.name"
                                        class="h-10 border border-gray-300 focus:ring-2 focus:ring-green-400 rounded-lg px-3 bg-gray-50"
                                        placeholder="Microsoft Excel, Photoshop etc.">

                                    <!-- กลุ่ม selector + ปุ่มลบ -->
                                    <div class="flex flex-wrap gap-2 md:contents">
                                        <select x-model="program.level" name="program_level"
                                            class="h-10 border border-gray-300 rounded-lg px-3 bg-gray-50">
                                            <option value="" disabled selected>เลือกความชำนาญ</option>
                                            <option>พื้นฐาน</option>
                                            <option>ปานกลาง</option>
                                            <option>ดีมาก</option>
                                        </select>

                                        <button type="button" class="text-red-500 font-bold px-2"
                                            @click="removeProgram(idx)" :disabled="programs.length === 1"
                                            :class="programs.length === 1 ? 'opacity-40 cursor-not-allowed' : ''"
                                            title="ลบโปรแกรมนี้">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>

                        {{-- ความสามารถในการพิมพ์ --}}
                        <div x-data="{ typing: '' }" class="bg-gray-50 p-4 rounded-lg mb-4">
                            <label class="block text-gray-700 font-semibold mb-2 mt-6">ความสามารถในการพิมพ์</label>
                            <div class="flex mb-2 md:justify-start">
                                <label for="typing_exc" class="inline-flex items-center gap-2  md:mr-20">
                                    <input type="radio" name="typing_speed" id="typing_exc" value="ดีมาก"
                                        class="accent-green-600 w-4 h-4" x-model="typing">
                                    <span>ดีมาก</span>
                                </label>
                                <label for="typing_good" class="inline-flex items-center gap-2 ml-4  md:mr-20">
                                    <input type="radio" name="typing_speed" id="typing_good" value="ดี"
                                        class="accent-green-600 w-4 h-4" x-model="typing">
                                    <span>ดี</span>
                                </label>
                                <label for="typing_fair" class="inline-flex items-center gap-2 ml-4  md:mr-20">
                                    <input type="radio" name="typing_speed" id="typing_fair" value="ปานกลาง"
                                        class="accent-green-600 w-4 h-4" x-model="typing">
                                    <span>ปานกลาง</span>
                                </label>
                                <label for="typing_no" class="inline-flex items-center gap-2 ml-4">
                                    <input type="radio" name="typing_speed" id="typing_no" value="ไม่ได้เลย"
                                        class="accent-green-600 w-4 h-4" x-model="typing">
                                    <span>ไม่ได้เลย</span>
                                </label>
                            </div>
                        </div>

                        <!-- Row 3 ความสามารถด้านภาษา -->
                        <div x-data="fnLanguageSkills()" class="bg-gray-50 p-4 rounded-lg">
                            <input type="hidden" name="langs" :value="JSON.stringify(langs.map(({ file, ...rest }) => rest))">
                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-gray-700 font-semibold mb-2 mt-6">ความสามารถด้านภาษา</label>
                                <button type="button"
                                    class="bg-green-500 hover:bg-green-700 text-white px-4 py-1 rounded-full flex items-center gap-1 text-sm mt-2"
                                    @click="langs.push({ name: '', level: '', file: null })">
                                    <i class="fa-solid fa-plus"></i> เพิ่มข้อมูล
                                </button>
                            </div>
                            <template x-for="(lang, idx) in langs" :key="idx">
                                <div class="space-y-2 md:grid md:grid-cols-[1.5fr_1fr_auto_auto] gap-6 mb-2 items-center ">

                                    <!-- ภาษาอื่น ๆ -->
                                    <input type="text" name="lang_name" x-model="lang.name"
                                        :readonly="[0, 1].includes(idx)"
                                        :class="{ 'bg-gray-200 text-gray-700': [0, 1].includes(idx) }"
                                        class="h-10 border border-gray-300 focus:ring-2 focus:ring-green-400 rounded-lg px-3 bg-gray-50 w-full"
                                        placeholder="ภาษาอื่น ๆ">

                                    <!-- selector + ปุ่มอัปโหลด + ปุ่มลบ (Respone มือถือ) -->
                                    <div class="flex flex-wrap items-center gap-2 md:contents">
                                        <!-- Selector -->
                                        <select x-model="lang.level" name="lang_level"
                                            class="h-10 border border-gray-300 rounded-lg px-3 bg-gray-50 md:col-start-2">
                                            <option value="" disabled selected>เลือกความชำนาญ</option>
                                            <option>พื้นฐาน</option>
                                            <option>ปานกลาง</option>
                                            <option>ดีมาก</option>
                                            <option>เจ้าของภาษา</option>
                                        </select>

                                        <!-- ปุ่มอัปโหลด -->
                                        <div class="flex md:flex-col items-center">
                                            <label
                                                class="cursor-pointer flex items-center justify-center h-10 w-10 rounded bg-green-500 hover:bg-green-700 text-white border border-gray-300 md:col-start-3"
                                                :title="'อัปโหลดใบคะแนน (' + lang.name + ')'">
                                                <i class="fa-solid fa-file-arrow-up"></i>
                                                <input type="file" :name="`langs_file_${idx}`" class="hidden" @change="uploadFile($event, idx)">
                                            </label>
                                            <!-- แสดงชื่อไฟล์ที่อัปโหลด -->
                                            <template x-if="lang.file">
                                                <span
                                                    class="px-2 py-2 text-xs text-blue-600 font-bold max-w-[140px] truncate"
                                                    x-text="lang.file.name" :title="lang.file.name"></span>
                                            </template>
                                        </div>

                                        <!-- ปุ่มลบ -->
                                        <button type="button" class="text-red-500 font-bold px-2 md:col-start-4"
                                            @click="langs.length > 2 ? langs.splice(idx, 1) : null"
                                            x-show="langs.length > 0" :disabled="langs.length === 2"
                                            :class="langs.length === 2 ? 'opacity-40 cursor-not-allowed' : ''"
                                            title="ลบภาษา">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <p class="text-xs text-gray-500 mt-2 ml-1">
                                <i class="fa-solid fa-file-arrow-up mr-2 "></i>อัปโหลดไฟล์ผลคะแนน CU-TFL, TOEIC, IELTS,
                                TOEFL, HSK, JLPT หรืออื่น ๆ (ถ้ามี)
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Section Training Course -->
                <div class="bg-white rounded-xl shadow-md p-8 mt-8" x-data="fnTraining()">
                    <input type="hidden" name="trainings" :value="JSON.stringify(trainings)">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-bold text-green-600">การอบรม การดูงาน การฝึกงาน</h2>
                        <button type="button"
                            class="bg-green-500 hover:bg-green-700 text-white px-4 py-1 rounded-full flex items-center gap-1 text-sm"
                            @click="addRow()">
                            <i class="fa-solid fa-plus"></i> เพิ่มข้อมูล
                        </button>
                    </div>

                    <p class="text-xs text-gray-500 mt-2 ml-1">
                        <span class="text-red-500">* </span>เรียงจากใหม่ไปเก่าสุด
                    </p>

                    <!-- กล่องรวมทั้งหมด -->
                    <div class="rounded-lg p-4 mt-4">
                        <template x-for="(training, idx) in trainings" :key="idx">
                            <!-- แถวข้อมูลแต่ละรายการ -->
                            <div class="grid md:grid-cols-[10%_16%_30%_35%_5%] gap-2 items-end mb-4"
                                :class="idx !== 0 ? 'border-t border-gray-500 pt-6 mt-4' : ''">
                                <!-- ปี + ระยะเวลา -->
                                <div class="col-span-1 md:col-span-2 flex gap-2">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">ปี (พ.ศ.)</label>
                                        <input type="text" name="training_year"
                                            class="w-20 h-10 md:w-full border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-green-400 rounded-lg px-2 py-1"
                                            placeholder="2566" x-model="training.year">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">ระยะเวลา</label>
                                        <input type="text" name="training_duration"
                                            class="w-32 h-10 md:w-36 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-green-400 rounded-lg px-2 py-1"
                                            placeholder="3 เดือน / 20 ชม." x-model="training.duration">
                                    </div>
                                </div>

                                <!-- หัวข้อ -->
                                <div class="col-span-1 md:col-span-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">หลักสูตร / หัวข้อ</label>
                                    <input type="text" name="training_topic"
                                        class="w-full h-10 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-green-400 rounded-lg px-2 py-1"
                                        placeholder="เช่น อบรมการใช้ AI ในการทำงาน" x-model="training.topic">
                                </div>

                                <!-- สถาบัน + ปุ่มลบ (มือถือ) -->
                                <div class="col-span-1 md:col-span-1 flex items-center">
                                    <div class="flex-1">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">ชื่อสถาบัน /
                                            เว็บไซต์</label>
                                        <input type="text" name="training_institution"
                                            class="w-full h-10 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-green-400 rounded-lg px-2 py-1"
                                            placeholder="สถาบัน... / เว็บไซต์..." x-model="training.institution">
                                    </div>
                                    <button type="button" class="ml-2 mt-6 text-red-500 font-bold py-2 px-2 md:hidden"
                                        title="ลบแถว" @click="removeRow(idx)" :disabled="trainings.length === 1"
                                        :class="trainings.length === 1 ? 'opacity-40 cursor-not-allowed' : ''">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>

                                <!-- ปุ่มลบ: Desktop -->
                                <button type="button"
                                    class="text-red-500 font-bold px-2 md:py-2 hidden md:block md:col-start-5 ml-4"
                                    title="ลบแถว" @click="removeRow(idx)" :disabled="trainings.length === 1"
                                    :class="trainings.length === 1 ? 'opacity-40 cursor-not-allowed' : ''">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Section Work Experience: ประวัติการทำงาน -->
                <div class="bg-white rounded-xl shadow-md p-8 mt-8" x-data="fnWorkExperience()">
                    <input type="hidden" name="works" :value="JSON.stringify(works)">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-bold text-green-600">ประวัติการทำงาน</h2>
                        <button type="button"
                            class="bg-green-500 hover:bg-green-700 text-white px-4 py-1 rounded-full flex items-center gap-1 text-sm"
                            @click="addRow()">
                            <i class="fa-solid fa-plus"></i> เพิ่มข้อมูล
                        </button>
                    </div>

                    <p class="text-xs text-gray-500 mt-2 ml-1">
                        <span class="text-red-500">* </span>เรียงจากใหม่ไปเก่าสุด
                    </p>

                    <div class="rounded-lg space-y-6">
                        <template x-for="(work, idx) in works" :key="idx">
                            <!-- แถวข้อมูลแต่ละรายการ -->
                            <div class="grid gap-4" :class="idx !== 0 ? 'border-t border-gray-500 pt-8 mt-4' : ''">
                                <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">สถานที่ทำงาน 
                                            {{-- <span class="text-red-500">*</span> --}}
                                        </label>
                                        <input type="text" name="work_company" x-model="work.company"
                                            class="w-full h-10 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-green-400 rounded-lg px-2 py-1"
                                            placeholder="บริษัท เอบีซี จำกัด">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">ตำแหน่ง 
                                            {{-- <span class="text-red-500">*</span> --}}
                                        </label>
                                        <input type="text" name="work_position" x-model="work.position"
                                            class="w-full h-10 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-green-400 rounded-lg px-2 py-1"
                                            placeholder="ตำแหน่งงานที่ทำ">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">งานที่รับผิดชอบ 
                                        {{-- <span class="text-red-500">*</span> --}}
                                    </label>
                                    <input type="text" name="work_respon" x-model="work.responsibility"
                                        class="w-full h-10 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-green-400 rounded-lg px-2 py-1"
                                        placeholder="เช่น ดูแลระบบ, เขียนโปรแกรม, ประสานงาน ฯลฯ">
                                </div>

                                <div class="grid grid-cols-3 gap-4 items-end">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">ระยะเวลาการทำงาน 
                                            {{-- <span class="text-red-500">*</span> --}}
                                        </label>
                                        <input type="text" name="work_duration" x-model="work.duration"
                                            class="w-full h-10 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-green-400 rounded-lg px-2 py-1"
                                            placeholder="เช่น 1 ปี 10 เดือน">
                                    </div>
                                    <div x-data="fnSalary()">
                                        <label for="currentsalary"
                                            class="block text-sm font-medium text-gray-700 mb-1">เงินเดือนล่าสุด 
                                            {{-- <span class="text-red-500">*</span> --}}
                                        </label>
                                        <input type="text" id="currentsalary" name="currentsalary"
                                            x-model="work.currentsalary"
                                            @input="work.currentsalary = formatNumber($event.target.value)" inputmode="numeric"
                                            class="w-full h-10 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-green-400 rounded-lg px-2 py-1"
                                            placeholder="เช่น 30,000">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">รายได้อื่น ๆ</label>
                                        <input type="text" name="work_income" x-model="work.otherIncome"
                                            @input="work.otherIncome = formatNumber($event.target.value)" inputmode="numeric"
                                            class="w-full h-10 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-green-400 rounded-lg px-2 py-1"
                                            placeholder="ระบุเป็นตัวเลข">
                                    </div>
                                </div>

                                <div class="grid md:grid-cols-[83%_15%] gap-4 items-end">
                                    <div class="flex items-end">
                                        <div class="flex-1">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">สาเหตุที่ออก 
                                                {{-- <span class="text-red-500">*</span> --}}
                                                </label>
                                            <input type="text" name="work_reason" x-model="work.reason"
                                                class="w-full h-10 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-green-400 rounded-lg px-2 py-1"
                                                placeholder="เช่น หมดสัญญา, เปลี่ยนสายงาน">
                                        </div>
                                        <button type="button"
                                            class="ml-2 mb-1 text-red-500 font-bold py-2 px-2 md:hidden" title="ลบแถว"
                                            @click="removeRow(idx)" :disabled="works.length === 1"
                                            :class="works.length === 1 ? 'opacity-40 cursor-not-allowed' : ''">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                    <button type="button"
                                        class="text-red-500 font-bold px-2 py-2 hidden md:block self-end" title="ลบแถว"
                                        @click="removeRow(idx)" :disabled="works.length === 1"
                                        :class="works.length === 1 ? 'opacity-40 cursor-not-allowed' : ''">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Section : คำถามเพิ่มเติม -->
                <div class="bg-white rounded-xl shadow-md p-8 mt-8">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-bold text-green-600">คำถามเพิ่มเติม</h2>
                    </div>
                    <div class="mb-4">
                        <p class="text-xs text-gray-500 mt-2 ml-1">
                            <span class="text-red-500">* </span>กรุณาตอบคำถามให้ครบ
                        </p>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8 text-sm text-gray-800">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <div class="space-y-4">
                                <p class="font-medium text-gray-800">1.
                                    ท่านเคยเป็นหนี้อยู่ในระหว่างการติดสัญญากับสถาบันการเงินหรือไม่</p>
                                <div class="flex gap-4">
                                    <label for="q1_yes"><input type="radio" id="q1_yes" name="q1"
                                            value="เคย"> เคย</label>
                                    <label for="q1_no"><input type="radio" id="q1_no" name="q1"
                                            value="ไม่เคย" required>
                                        ไม่เคย</label>
                                </div>
                            </div>

                            <div>
                                <p class="font-medium text-gray-800">2.
                                    รายชื่อสถาบันทางการเงินที่ท่านเคยใช้บริการหรือใช้บริการย้อนหลังอยู่ ณ ปัจจุบัน</p>
                                <input type="text" id="q2" name="q2"
                                    class="w-full border border-gray-300 focus:ring-2 focus:ring-green-400 rounded-lg px-3 py-2 bg-gray-50">
                            </div>

                            <div class="space-y-4">
                                <p class="font-medium text-gray-800">3. ท่านเคยเล่นหรือเคยเกี่ยวข้องกับการพนันใด ๆ หรือไม่
                                </p>
                                <div class="flex gap-4">
                                    <label for="q3_yes"><input type="radio" id="q3_yes" name="q3"
                                            value="เคย"> เคย</label>
                                    <label for="q3_no"><input type="radio" id="q3_no" name="q3"
                                            value="ไม่เคย" required>
                                        ไม่เคย</label>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <p class="font-medium text-gray-800">4. ท่านเคยต้องโทษหรือต้องคดีอาญาหรือไม่</p>
                                <div class="flex gap-4">
                                    <label for="q4_yes"><input type="radio" id="q4_yes" name="q4"
                                            value="เคย"> เคย</label>
                                    <label for="q4_no"><input type="radio" id="q4_no" name="q4"
                                            value="ไม่เคย" required>
                                        ไม่เคย</label>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <p class="font-medium text-gray-800">5. ท่านเคยเสพสิ่งเสพติดหรือของมึนเมาหรือไม่</p>
                                <div class="flex gap-4">
                                    <label for="q5_yes"><input type="radio" id="q5_yes" name="q5"
                                            value="เคย"> เคย</label>
                                    <label for="q5_no"><input type="radio" id="q5_no" name="q5"
                                            value="ไม่เคย" required>
                                        ไม่เคย</label>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <p class="font-medium text-gray-800">6. ท่านไม่ใช่บุคคลตั้งครรภ์ใช่หรือไม่</p>
                                <div class="flex gap-4">
                                    <label for="q6_yes"><input type="radio" id="q6_yes" name="q6"
                                            value="ใช่"> ใช่</label>
                                    <label for="q6_no"><input type="radio" id="q6_no" name="q6"
                                            value="ไม่ใช่" required>
                                        ไม่ใช่</label>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <p class="font-medium text-gray-800">7. ท่านเคยมีประวัติการรักษาหรือโรคประจำตัว
                                    หรือรักษาทางจิตหรือไม่</p>
                                <div class="flex gap-4">
                                    <label for="q7_yes"><input type="radio" id="q7_yes" name="q7"
                                            value="เคย"> เคย</label>
                                    <label for="q7_no"><input type="radio" id="q7_no" name="q7"
                                            value="ไม่เคย" required>
                                        ไม่เคย</label>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <div class="space-y-4">
                                <p class="font-medium text-gray-800">8.
                                    ท่านเคยขึ้นทะเบียนเป็นผู้ประกันตนกับสำนักงานประกันสังคมหรือไม่</p>
                                <div class="flex gap-4">
                                    <label for="q8_yes"><input type="radio" id="q8_yes" name="q8"
                                            value="เคย" required> เคย</label>
                                    <label for="q8_no"><input type="radio" id="q8_no" name="q8"
                                            value="ไม่เคย">
                                        ไม่เคย</label>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <p class="font-medium text-gray-800">9. ท่านยอมรับการทดลองงาน 119 วันหรือไม่</p>
                                <div class="flex gap-4">
                                    <label for="q9_yes"><input type="radio" id="q9_yes" name="q9"
                                            value="ยอมรับ" required>
                                        ยอมรับ</label>
                                    <label for="q9_no"><input type="radio" id="q9_no" name="q9"
                                            value="ไม่ยอมรับ">
                                        ไม่ยอมรับ</label>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <p class="font-medium text-gray-800">10.
                                    ท่านเคยเข้าร่วมกิจกรรมของคณะกรรมการลูกจ้าง/สหภาพแรงงานหรือไม่</p>
                                <div class="flex gap-4">
                                    <label for="q10_yes"><input type="radio" id="q10_yes" name="q10"
                                            value="เคย">
                                        เคย</label>
                                    <label for="q10_no"><input type="radio" id="q10_no" name="q10"
                                            value="ไม่เคย" required>
                                        ไม่เคย</label>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <p class="font-medium text-gray-800">11. ท่านมีภาระค่าใช้จ่ายในครอบครัวหรือไม่</p>
                                <div class="flex gap-4">
                                    <label for="q11_yes"><input type="radio" id="q11_yes" name="q11"
                                            value="มี" required> มี</label>
                                    <label for="q11_no"><input type="radio" id="q11_no" name="q11"
                                            value="ไม่มี">
                                        ไม่มี</label>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <p class="font-medium text-gray-800">12. ท่านเคยได้รับการรักษาโรคร้ายแรงหรือไม่</p>
                                <div class="flex gap-4">
                                    <label for="q12_yes"><input type="radio" id="q12_yes" name="q12"
                                            value="เคย">
                                        เคย</label>
                                    <label for="q12_no"><input type="radio" id="q12_no" name="q12"
                                            value="ไม่เคย" required>
                                        ไม่เคย</label>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <p class="font-medium text-gray-800">13. ในครอบครัวท่านเคยมีโรคติดต่อร้ายแรงหรือไม่</p>
                                <div class="flex gap-4">
                                    <label for="q13_yes"><input type="radio" id="q13_yes" name="q13"
                                            value="มี"> มี</label>
                                    <label for="q13_no"><input type="radio" id="q13_no" name="q13"
                                            value="ไม่มี" required>
                                        ไม่มี</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Reference: บุคคลอ้างอิง -->
                <div class="bg-white rounded-xl shadow-md p-8 mt-8">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-bold text-green-600">บุคคลที่สามารถติดต่อได้</h2>
                    </div>

                    <p class="text-xs text-gray-500 mt-2 ml-1">
                        <span class="text-red-500">* </span>บุคคลที่สามารถติดต่อได้ในกรณีฉุกเฉิน
                    </p>

                    <div>
                        <div class="flex items-center grid md:grid-cols-3 gap-6 items-end mt-6">
                            <div>
                                <label class="block text-gray-700 font-semibold">ชื่อ-นามสกุล<span class="text-red-500">
                                        *</span></label>
                                <input type="text" name="reference_name" required
                                    class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold">ความสัมพันธ์<span class="text-red-500">
                                        *</span></label>
                                <input type="text" name="reference_relation" required
                                    class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                            </div>
                            <div x-data="phoneFormat" class="w-full">
                                <label class="block text-gray-700 font-semibold">
                                    เบอร์โทรศัพท์ <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="reference_phone" name="reference_phone" x-model="phone"
                                    @input="phone = formatPhone(phone)" maxlength="12" inputmode="numeric" required
                                    class="w-full h-10 border border-gray-300 rounded-lg px-3 bg-gray-50 focus:ring-2 focus:ring-green-400">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section :  ข้อมูลเพิ่มเติม-->
                <div class="bg-white rounded-xl shadow-md p-8 mt-8">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-bold text-green-600">ข้อมูลเพิ่มเติมสำหรับผู้สมัครงาน</h2>
                    </div>

                    <div>
                        <div class="flex items-center grid md:grid-cols-2 gap-6 items-end mt-6">
                            <div>
                                <label class="block text-gray-700 font-semibold">ท่านทราบข่าวการรับสมัครจาก</label>
                                <select name="application_source" id="application_source" required
                                    class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                                    <option value="" disabled selected>กรุณาเลือก</option>
                                    <!-- เว็บไซต์หางาน -->
                                    <option value="jobbkk">JobBKK</option>
                                    <option value="jobthai">JobThai</option>
                                    <option value="thaijob">ThaiJob</option>
                                    <option value="jobtopgun">JobTopGun</option>

                                    <!-- โซเชียลมีเดีย -->
                                    <option value="facebook">Facebook</option>
                                    <option value="tiktok">TikTok</option>
                                    <option value="instagram">Instagram</option>
                                    <option value="linkedin">LinkedIn</option>

                                    <option value="friend">เพื่อน/คนรู้จักแนะนำ</option>
                                    <option value="company_website">เว็บไซต์บริษัทโดยตรง</option>

                                    <!-- งานกิจกรรม -->
                                    <option value="jobfair">Job Fair</option>
                                    <option value="other">อื่นๆ</option>
                                </select>
                            </div>

                            <div x-data="{ today: '' }" x-init="today = new Date().toISOString().split('T')[0]">
                                <label class="block text-gray-700 font-semibold mb-1">วันที่พร้อมเริ่มปฏิบัติงาน <span class="text-red-500">*</span></label>
                                <input type="date" name="start_work" :min="today" required
                                    class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                            </div>
                        </div>
                    </div>

                    <!-- Section: เงื่อนไขการให้บริการและข้อมูลส่วนบุคคล -->

                    <div x-data="modalAgreement()" class="p-4 sm:p-8">
                        <div class="grid justify-center gap-4">

                            <!-- Checkbox: Terms of Service -->
                            {{-- <div class="flex items-center flex-wrap text-sm text-gray-700 gap-2">
                                <input type="checkbox" id="tos" name="tos" value="1" required class="accent-green-600 w-4 h-4">
                                <label for="tos" class="font-medium">ยอมรับ</label>
                                <a href="#" @click.prevent="openModal('tos')" class="text-blue-600 hover:underline">
                                    เงื่อนไขการให้บริการ
                                </a>
                            </div> --}}

                            <!-- Checkbox: Privacy Policy -->
                            <div class="flex items-center flex-wrap text-sm text-gray-700 gap-2">
                                <input type="checkbox" id="privacy" name="privacy" value="1" required class="accent-green-600 w-4 h-4">
                                <label for="privacy" class="font-medium">ยอมรับ</label>
                                <a href="#" @click.prevent="openModal('privacy')" class="text-blue-600 hover:underline">
                                    นโยบายความเป็นส่วนตัว
                                </a>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div
                            x-show="show"
                            x-transition
                            x-cloak
                            @keydown.escape.window="closeModal()"
                            @click.self="closeModal()"
                            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                            role="dialog"
                            aria-modal="true"
                        >
                            <div class="bg-white rounded-lg shadow-xl w-[55vw] max-w-5xl h-[90vh] p-4 sm:p-6 flex flex-col">
                                <h2 class="text-lg font-semibold mb-4" x-text="modalTitle"></h2>
                                <div class="flex-1 overflow-y-auto max-h-full text-sm text-gray-700 mb-6" x-html="modalContent"></div>
                                <div class="flex justify-end gap-2">
                                    <button
                                        type="button"
                                        @click="closeModal()"
                                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 text-sm"
                                    >
                                        ปิด
                                    </button>
                                    <button
                                        type="button"
                                        @click="accept()"
                                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm"
                                    >
                                        ยอมรับ
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="pdpaContent" style="display: none">
                    <h1 class="font-bold">หนังสือให้ความยินยอม</h1>
                    <h2 class="font-bold">การเก็บรวบรวม ประมวลผล ใช้ และ/หรือเปิดเผยข้อมูลส่วนบุคคล สำหรับผู้สมัครงาน</h2>
                    <h2 class="font-bold">สําหรับผู้สมัครงาน</h2>
                    <p>
                        บริษัท วี บียอนด์ ดีเวลอปเม้นท์ จำกัด (มหาชน) (ต่อไปนี้จะเรียกว่า “บริษัท”) ให้ความสำคัญและมุ่งมั่นในการคุ้มครองข้อมูลส่วนบุคคลของเจ้าของข้อมูล (ต่อไปนี้จะเรียกว่า “ผู้สมัครงาน”) ที่ได้ติดต่อเข้ามาสมัครงานกับบริษัท ดังนั้นบริษัทจึงได้กำหนดมาตรการที่เหมาะสมสำหรับการรักษาความมั่นคงปลอดภัยของข้อมูลส่วนบุคคลโดยเฉพาะการเก็บรวบรวม ประมวลผล ใช้ และ/หรือเปิดเผย ข้อมูลส่วนบุคคลของผู้สมัครงาน รวมถึงแนวทางในการปฏิบัติตาม พ.ร.บ.คุ้มครองข้อมูลส่วนบุคคล พ.ศ.2562 และกฎหมายที่เกี่ยวข้องกับข้อมูลส่วนบุคคล ทั้งนี้เพื่อให้ผู้สมัครงานได้รับทราบ และเข้าใจถึงการคุ้มครองข้อมูลส่วนบุคคลของผู้สมัครงานดังต่อไปนี้
                    </p>
                    <br>
                    <h2 class="font-bold">ข้อมูลส่วนบุคคลที่ บริษัทเก็บรวบรวม</h2>
                    <p>
                        บริษัทได้รับข้อมูลส่วนบุคคลของผู้สมัครงาน และได้เก็บรวบรวมและประมวลผลตามหนังสือให้ความยินยอมการเก็บ รวบรวม ประมวลผล ใช้ และ/หรือเปิดเผยข้อมูลส่วนบุคคลฉบับนี้โดยบริษัทได้จัดเก็บรวบรวม และประมวลผลข้อมูลส่วนบุคคลเท่าที่จำเป็นตามวัตถุประสงค์ในการเก็บรวบรวม ประมวลผล ใช้ และ/หรือเปิดเผยข้อมูลส่วนบุคคลของบริษัท ทั้งนี้ได้จำแนกประเภทของข้อมูลส่วนบุคคลดังนี้
                    </p>
                    <br>
                    <table border="1" style="width:100%; border: 1px solid #ddd;">
                        <thead>
                            <tr>
                                <th style="width: 30%">ประเภทของข้อมูลส่วนบุคคล</th>
                                <th style="width: 70%">รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ml-3">ข้อมูลส่วนบุคคลพื้นฐาน</td>
                                <td>ได้แก่ คำนำหน้าชื่อ นามสกุล ชื่อเล่น รูปถ่าย ลายมือชื่อ เลขที่ประจำตัว ประชาชน ที่อยู่ ปัจจุบัน อีเมล หมายเลขโทรศัพท์ วันเดือนปีเกิด อายุ สถานภาพการสมรส สถานภาพ ทางทหาร ประวัติการศึกษา ประวัติการทำงาน ข้อมูลเครดิต</td>
                            </tr>
                            <tr>
                                <td>ข้อมูลส่วนบุคคลที่มีความอ่อนไหว</td>
                                <td>ได้แก่ ข้อมูลประวัติอาชญากรรม เชื้อชาติ ศาสนา ฯ</td>
                            </tr>
                            <tr>
                                <td>ข้อมูลบุคคลที่สาม/บุคคลอ้างอิง</td>
                                <td>ได้แก่ คู่สมรส สมาชิกในครอบครัว บุคคลติดต่อกรณีฉุกเฉิน โดยจัดเก็บ ข้อมูลส่วนบุคคล อันได้แก่ ชื่อ นามสกุล ความสัมพันธ์ หมายเลขโทรศัพท์ และข้อมูลอื่นๆ เท่าที่จำเป็น</td>
                            </tr>
                            <tr>
                                <td>ข้อมูลด้านเทคนิค สำหรับผู้สมัครผ่านเว็บไซต์/ช่องทางออนไลน์ของบริษัท</td>
                                <td>ได้แก่ ข้อมูลการเข้าใช้งานเว็บไซต์และระบบต่างๆ ข้อมูลจราจรทางคอมพิวเตอร์(Log) ข้อมูลการติดต่อและสื่อสารระหว่างเจ้าของข้อมูล และผู้ใช้งานรายอื่น ข้อมูลจากการบันทึกการใช้งาน เช่น ตัวระบุ อุปกรณ์ หมายเลข IP ของคอมพิวเตอร์ รหัสประจำตัวอุปกรณ์ ประเภทอุปกรณ์ ข้อมูลเครือข่ายมือถือ ข้อมูลการเชื่อมต่อ ข้อมูลตำแหน่งที่ตั้งทางภูมิศาสตร์ ประเภทเบราว์เซอร์ (Browser) ข้อมูลบันทึกการเข้าออกระบบต่างๆ หรือ เว็บไซต์ที่มีการเข้าถึงก่อนและหลัง (Referring Website) ข้อมูลบันทึกประวัติการใช้ ระบบข้อมูลบันทึกเวลาเข้าออกสำนักงาน ข้อมูลบันทึกการเข้าสู่ระบบ (Login Log) ข้อมูลรายการการทำธุรกรรม (Transaction log) ข้อมูลพฤติกรรมการใช้งาน สถิติการเข้าระบบ เวลาที่เยี่ยมชมระบบ (Access Time) ที่ได้เก็บรวบรวมผ่านคุกกี้ (Cookies) หรือเทคโนโลยีอื่นๆที่คล้ายกัน</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <h2 class="font-bold"><u>การเก็บรวบรวมข้อมูล</u></h2>
                    <ol>
                        <li>
                            <p class="font-medium">1.ได้รับข้อมูลส่วนบุคคลโดยตรง</p>
                            บริษัทได้รับข้อมูลส่วนบุคคลของผู้สมัครงานโดยตรง โดยเก็บรวบรวมข้อมูลส่วนบุคคลจากระบวนการสรรหาและรับสมัครงาน หรือหนังสือให้ความยินยอม ทั้งนี้ในบางกรณีบริษัทอาจจะได้รับข้อมูลจากบุคคลที่สามในกรณีอื่นด้วย
                        </li>
                        <li>
                            <p class="font-medium">2.ได้รับข้อมูลส่วนบุคคลของบุคคลอื่นโดยตรง</p>
                            ข้อมูลส่วนบุคคลของบุคคลอื่นที่ผู้สมัครงานได้ให้ไว้กับบริษัทซึ่งอาจจะให้ข้อมูลส่วนบุคคลที่เกี่ยวกับบุคคลอื่น ได้แก่ บุคคลติดต่อกรณีฉุกเฉิน ซึ่งบริษัทใช้ข้อมูลเหล่านั้นเพื่อการติดต่อในกรณีที่เกี่ยวกับการสมัครงานเท่านั้น
                        </li>
                        <li>
                            <p class="font-medium">3.บริษัทอาจรวบรวมข้อมูลส่วนบุคคลจากองค์กรอื่น</p>
                            บริษัทอาจรวบรวมข้อมูลจากองค์กรอื่นเพื่อกระบวนการสรรหาและคัดเลือกพนักงาน ได้แก่ กรณีที่ผู้สมัครงานมีการสมัครงานผ่านตัวแทน รับจ้างจัดหางาน หรือเว็บไซต์หางาน เป็นต้น
                        </li>
                        <li>
                            <p class="font-medium">4.บริษัทอาจจัดเก็บบันทึกข้อมูลการเข้าออกเว็บไซต์ (Log Files) ของท่าน</p> โดยจะจัดเก็บข้อมูลดังนี้ หมายเลขไอพี (IP Address) หรือเวลาการเข้าใช้งาน เป็นต้น
                        </li>
                    </ol>
                    <br>
                    <h2 class="font-bold"><u>วัตถุประสงค์ และฐานในการดำเนินการประมวลผลข้อมูล</u></h2>
                    <p>
                        บริษัทจะดำเนินการประมวลผลข้อมูลส่วนบุคคลของผู้สมัครงาน โดยจะกระทำโดยมีวัตถุประสงค์ ขอบเขต และใช้วิธีการที่ชอบด้วยกฎหมาย โปร่งใส และเป็นธรรมภายใต้ฐานการประมวลผลดังต่อไปนี้
                    </p>
                    <ol>
                        <li>1.เพื่อการปฏิบัติตามพันธะสัญญาการจ้างงานของบริษัท หรือเพื่อใช้ในการดำเนินการตามคำขอก่อนที่จะเข้ามาเป็นพนักงานของบริษัทตามกระบวนการสมัครงาน</li>
                        <li>2.เพื่อความจําเป็นในการปฏิบัติตามกฎหมาย และเพื่อประโยชน์โดยชอบด้วยกฎหมายของบริษัทซึ่งจะไม่ละเมิดสิทธิพื้นฐาน หรือสิทธิทางเสรีภาพของเจ้าของข้อมูล</li>
                        <li>3.เพื่อรวบรวมข้อมูลเป็นฐานข้อมูลของบริษัท หรือข้อมูลเชิงสถิติเกี่ยวกับจำนวนผู้เยี่ยมชมเว็บไซต์</li>
                    </ol>
                    <p>
                        บริษัทจะประมวลผลข้อมูลส่วนบุคคลของผู้สมัครงานตามความจำเป็นเพื่อประเมินความเหมาะสมของผู้สมัครงานต่อตำแหน่งงาน และเพื่อตรวจสอบความถูกต้องของข้อมูลที่ได้ให้ไว้กับบริษัท
                    </p>
                    <br>
                    <table border="1" style="width:100%; border-collapse: collapse; border: 1px solid #ddd;">
                        <thead>
                            <tr>
                                <th style="width: 30%">วัตถุประสงค์ในการดำเนินการ</th>
                                <th style="width: 70%">รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1. เพื่อกระบวนการสรรหาบุคลากร</td>
                                <td>
                                    1) บริษัทใช้ข้อมูลส่วนบุคคลของผู้สมัครงานเพื่อประเมินว่าผู้สมัครงานนั้น เหมาะสมกับบทบาทหน้าที่ในตำแหน่งงานที่บริษัทต้องการสรรหาอยู่หรือไม่ และเพื่อจัดการเรื่องของการสัมภาษณ์งาน หรือการประเมินต่างๆ เมื่อได้ทำการสมัครงานกับบริษัทโดยตรง หรือผ่านทางตัวแทนรับจ้างจัดหางาน หรือบุคคลที่สาม ซึ่งจะรวมถึงการติดต่อผู้สมัครงาน เพื่อตระเตรียม ดำเนินการประเมิน และให้ข้อมูลตอบกลับ (Feedback) เกี่ยวกับการประเมินผลและสัมภาษณ์ รวมถึงในกรณีที่บริษัทเสนอการจ้างงานแก่ผู้สมัครงาน<br>
                                    2) เพื่อประเมินว่าผู้สมัครงานมีความเหมาะสมที่จะทำงานในตำแหน่งงานที่ได้สมัครมาหรือไม่ บริษัทอาจขอให้ผู้สมัครงานตอบคำถามเกี่ยวกับ รายละเอียดบุคลิกภาพโดย ข้อมูลนั้นอาจจะได้มาทั้งจากผู้สมัครงานเองหรือจากบริษัท<br>
                                    3) ผู้จัดการในหน่วยงานที่เปิดรับสมัครงานหรือหน่วยงานที่เกี่ยวข้องของ บริษัทนั้น อาจมีการคัดสรรใบสมัครเพื่อการสัมภาษณ์ โดยจะยึดจาก รายละเอียดที่ผู้สมัครงานได้ให้ข้อมูลการสมัครงานไว้
                                </td>
                            </tr>
                            <tr>
                                <td>2. เพื่อตรวจสอบประวัติการทำงานก่อนการจ้างงาน</td>
                                <td>
                                    1) เพื่อตรวจสอบในกรณีที่ผู้สมัครงานเคยมีประวัติการทำงานกับบริษัท และเหตุผลที่ได้ลาออกไป รวมถึงตรวจสอบว่าเคยสมัครงานกับบริษัทมาก่อนหรือไม่ และตรวจสอบว่าผู้สมัครงานมีความสนใจในตำแหน่งงานอื่นในบริษัทหรือไม่<br>
                                    2) เพื่อดำเนินการตรวจสอบก่อนการจ้างงาน เพื่อประเมินความสามารถในการทำงานของผู้สมัครงาน โดยเป็นไปตามที่กฎหมายอนุญาตให้ทำได้ ได้แก่ คุณสมบัติด้านวิชาชีพ ข้อมูลเครดิตบูโร ประวัติอาชญากรรม และการตรวจเช็คจากบุคคลอ้างอิงที่ผู้สมัครงานได้ให้ข้อมูลไว้กับบริษัท
                                </td>
                            </tr>
                            <tr>
                                <td>3. เพื่อการพิจารณาตำแหน่งงานอื่นที่เหมาะสมในอนาคต</td>
                                <td>
                                    1) หากผู้สมัครงานไม่ประสบความสำเร็จในการประเมินสำหรับตำแหน่งงานที่ได้สมัครไว้ บริษัทจะเก็บรายละเอียดของผู้สมัครงานในฐานข้อมูลของบริษัทเป็นเวลา 3 เดือนเพื่อที่บริษัทจะสามารถติดต่อในกรณีที่มีตำแหน่งงานใด ๆ ในอนาคตที่อาจจะเหมาะสม<br>
                                    2) ในกรณีที่ผู้สมัครงานต้องการให้ลบข้อมูล ผู้สมัครงานสามารถติดต่อมายังหน่วยงานทรัพยากรบุคคลของบริษัทที่อีเมล hr@vbeyond.co.th
                                </td>
                            </tr>
                            <tr>
                                <td>4. เพื่อใช้งานด้านแอพพลิเคชั่น บนเครื่องมือ ส่วนตัว</td>
                                <td>
                                    ㆍข้อมูลบัญชีผู้ใช้งานแอพพลิเคชั่น (Account) เมื่อผู้ใช้งานใช้งานแอพพลิเคชั่นของบริษัทฯ บริษัทฯอาจเข้าถึง รวบรวมและประมวลผลข้อมูลเกี่ยวกับ บัญชีผู้ใช้งานแอพพลิเคชั่น (Account) ของผู้ใช้งาน สำหรับการตรวจสอบ Token และ/หรือ UDID ของเครื่องโทรศัพท์เคลื่อนที่/อุปกรณ์ดิจิตอล เพื่อการ log-in และตรวจสอบ account ผู้ใช้งาน หรือการจัดทำข้อความแจ้งโฆษณาประชาสัมพันธ์เกี่ยวกับแอพพลิเคชั่นไปยังผู้ใช้งาน<br>
                                    คุกกี้และเทคโนโลยีที่คล้ายกัน (Cookies and Similar Technologies) บริษัทฯกับบริษัทในเครือ และ/หรือพันธมิตรทางธุรกิจของบริษัทฯ อาจใช้ เทคโนโลยีต่างๆ ในการรวบรวมและจัดเก็บข้อมูลเมื่อผู้ใช้งานเยี่ยมชมเว็บไซต์และ/หรือบริการของบริษัท โดยการใช้คุกกี้และเทคโนโลยีที่คล้ายกัน เพื่อระบุบราวเซอร์หรืออุปกรณ์ และ/หรือเพื่อรวบรวมและจัดเก็บข้อมูลเมื่อผู้ใช้งานมีการโต้ตอบกับบริการที่บริษัทฯให้กับบริษัทในเครือ และ/หรือพันธมิตร ทางธุรกิจของบริษัทฯ เช่น หัวข้อบริการที่สนใจ หรือ บริการโฆษณา เป็นต้น<br>
                                    ข้อมูลที่ถูกบันทึก : เมื่อผู้ใช้งานเรียกดูข้อมูลและ/ หรือรายงานจากแอพพลิเคชั่น บริษัทจะบันทึกการเรียกดูข้อมูลและ/หรือเนื้อหาดังกล่าวไว้ในแหล่งรวบรวมดังต่อไปนี้ ในเซิร์ฟเวอร์ของบริษัทเอง และ/หรือของบริษัทในเครือ และ/หรือของคู่สัญญาที่ชื่อถือได้ของบริษัทที่ทำหน้าที่บริหารจัดการข้อมูลในแอพพลิเคชั่นตามสัญญา<br>
                                    2.2 การเปิดเผยและใช้งานข้อมูลส่วนบุคคล<br>
                                    ข้อมูลส่วนบุคคลของผู้ใช้งานที่บริษัทได้รับ ซึ่งสามารถบ่งบอกตัวบุคคลของผู้ใช้งานได้ และเป็นข้อมูลส่วนบุคคลที่มีความสมบูรณ์และเป็นปัจจุบัน จะถูกนำไป ใช้ให้เป็นไปตามวัตถุประสงค์การดำเนินงานของบริษัทฯเท่านั้น และบริษัทฯจะดำเนินมาตรการที่เข้มงวดในการรักษาความมั่นคงปลอดภัย ตลอดจนการป้องกัน มิให้มีการนำข้อมูลส่วนบุคคลไปใช้โดยมิได้รับอนุญาตจากผู้ใช้งานก่อน<br>
                                    บริษัทฯจะใช้ เปิดเผยข้อมูลส่วนบุคคลของผู้ใช้งานได้ ตามความยินยอมของผู้ใช้งานโดยจะต้องเป็นการใช้ตามวัตถุประสงค์ของการเก็บรวบรวม จัดเก็บ ข้อมูลของบริษัทเท่านั้น<br>
                                    บริษัทฯจะดูแลให้ผู้ปฏิบัติงานของบริษัทมิให้เปิดเผย แสดง หรือทำให้ปรากฏในลักษณะอื่นใดซึ่งข้อมูลส่วนบุคคลของผู้ใช้งานนอกเหนือไปจากวัตถุประสงค์หรือ ต่อบุคคลภายนอก เว้นแต่<br>
                                    ㆍ เป็นกรณีที่กฎหมายกำหนด เช่น พระราชบัญญัติการประกอบกิจการโทรคมนาคม พระราชบัญญัติว่าด้วยการกระทำความผิดทางคอมพิวเตอร์ พระราช บัญญัติป้องกันและปราบปรามการฟอกเงิน เป็นต้น<br>
                                    ได้รับความยินยอมโดยชัดแจ้งจากผู้ใช้งาน<br>
                                    เป็นไปเพื่อประโยชน์เกี่ยวกับชีวิต สุขภาพ หรือความปลอดภัยของผู้ใช้งานและ/หรือผู้ใช้บริการอื่น<br>
                                    เพื่อประโยชน์แก่การสอบสวนของพนักงานสอบสวน หรือการพิจารณาพิพากษาคดีของศาล<br>
                                    เพื่อประโยชน์ในการศึกษา วิจัย หรือการจัดทำสถิติ หรือ เพื่อประโยชน์สาธารณะวัตถุประสงค์ในการรวบรวม จัดเก็บ ข้อมูลส่วนบุคคล<br>
                                    บริษัทรวบรวม จัดเก็บ ใช้ ข้อมูลส่วนบุคคลของผู้ใช้งาน เพื่อการดำเนินงานของบริษัทฯในการให้บริการด้าน...การคำนวณและเรียกเก็บค่าใช้บริการ การศึกษา วิเคราะห์ข้อมูลซึ่งเป็นไปตามวัตถุประสงค์ของการดำเนินงานของบริษัท และเพื่อปรับปรุงคุณภาพของการให้บริการของบริษัทให้มีประสิทธิภาพมากยิ่งขึ้นบริษัทฯจะใช้ข้อมูลที่รวบรวมจากแอพพลิเคชั่นทั้งหมดของบริษัท เพื่อให้บริการ บำรุงรักษา ป้องกัน ปรับปรุง พัฒนาบริการใหม่ๆ และปกป้องบริษัทฯและผู้ใช้ งาน ตลอดจนเพื่อนำเสนอเนื้อหาที่ได้รับการปรับแต่ง (Customize) ให้เหมาะสมกับการใช้งานของผู้ใช้งานโดยเฉพาะ เช่น แสดงผลการค้นหาที่เกี่ยวข้องกับผู้ ใช้งาน แสดงโฆษณาประชาสัมพันธ์บริการที่ผู้ใช้งานอาจสนใจและเป็นประโยชน์แก่ผู้ใช้งาน<br>
                                    "นอกจากนี้เมื่อผู้ใช้งานติดต่อมายังบริษัทฯ บริษัทฯอาจเก็บบันทึกข้อมูล ที่อยู่อีเมลล์ ปัญหา หรือข้อเสนอแนะของผู้ใช้งานผ่าน ""ช่องทางการติดต่อ"" เพื่อนำมาใช้ในการให้คำปรึกษา แนะนำวิธีการแก้ปัญหาที่เกี่ยวข้องกับการใช้งานอุปกรณ์ และแอพพลิเคชั่น ในการนำมาปรับปรุงและพัฒนาการให้บริการของบริษัท บริษัทในเครือ และพันธมิตรทางธุรกิจ และแจ้งให้ผู้ใช้งานทราบผ่านที่อยู่ที่ผู้ใช้งานแจ้งไว้"<br>
                                    หากภายหลังมีการเปลี่ยนแปลงวัตถุประสงค์ในการเก็บรวบรวมข้อมูลส่วนบุคคล บริษัทฯจะประกาศให้ผู้ใช้งานทราบ การแจ้งล่วงหน้าให้ผู้ใช้งานทราบก่อน 15 วัน โดยการส่งทางจดหมายอิเล็กทรอนิกส์ หรือประกาศไว้ในหน้าแรกของเว็บไซต์ เว้นแต่กฎหมายจะกำหนดไว้เป็นอย่างอื่น<br>
                                    2.1 ข้อมูลที่รวบรวมและเหตุผลที่รวบรวม<br>
                                    ให้ผู้ใช้งานแจ้งหรือกรอกข้อมูลส่วนบุคคลของผู้ใช้งาน เช่น ชื่อ-นามสกุล ที่อยู่ หมายเลขโทรศัพท์มือถือ เป็นต้น สำหรับแอพพลิเคชั่นที่ต้องให้มีการลง ทะเบียนก่อนการใช้งาน เพื่อจัดเก็บและบันทึกไว้ในบัญชีผู้ใช้งาน ตลอดจนเพื่อใช้ในการจัดเก็บค่าใช้บริการต่างๆ ภายในแอพพลิเคชั่น<br>
                                    บริษัทรวบรวมข้อมูลจากการใช้งานแอพพลิเคชั่นของผู้ใช้งาน ซึ่งประกอบด้วยข้อมูลอย่างน้อยดังนี้<br>
                                    ㆍข้อมูลเครื่องโทรศัพท์เคลื่อนที่/อุปกรณ์: บริษัทจะรวบรวมข้อมูลหมายเลขโทรศัพท์เคลื่อนที่ ตลอดจนหมายเลขอุปกรณ์ ที่ทำให้บริษัททราบว่าผู้ใช้งานเข้า ใช้งานแอพพลิเคชั่นจากอุปกรณ์ ใด เพื่อนำมาเก็บไว้ที่ server ของบริษัท และใช้ปรับแต่งการให้บริการและวิเคราะห์ปัญหาที่เหมาะสมกับอุปกรณ์นั้นๆ และใช้ SMS สำหรับส่งข้อมูล OTP สำหรับการลงทะเบียนใช้งาน<br>
                                    ข้อมูลกล้องถ่ายรูป (Camera) เมื่อผู้ใช้งานใช้งานแอพพลิเคชั่นนี้ บริษัทอาจเข้าถึงรวบรวม และประมวลผลข้อมูลรูปถ่าย วิดีโอ และสถานที่ของรูปถ่าย และ/หรือวิดีโอของผู้ใช้งาน เพื่อให้แอพพลิเคชั่นสามารถสแกน QR-Code อุปกรณ์ดิจิตอลที่ใช้งานได้ หรือ ใช้รูปภาพสำหรับแสดง profile ของผู้ใช้ งานแอพพลิเคชั่น<br>
                                    ข้อมูลตำแหน่ง (Location) เมื่อผู้ใช้งานใช้งานแอพพลิเคชั่นของบริษัท บริษัทฯอาจเข้าถึง รวบรวมและประมวลผลข้อมูลเกี่ยวกับตำแหน่งที่แท้จริงของผู้ ใช้งานผ่านเทคโนโลยีที่หลากหลายในการระบุตำแหน่ง เช่น ที่อยู่ IP, GPS เซ็นเซอร์หรือเครื่องมืออื่นๆ ผ่านอุปกรณ์ ของบริษัทฯ เพื่อใช้ระบุตำแหน่ง ปัจจุบันของผู้ใช้บนแผนที่ และเส้นทาง<br>
                                    ข้อมูลบัญชีผู้ใช้งานแอพพลิเคชั่น (Account) เมื่อผู้ใช้งานใช้งานแอพพลิเคชั่นของบริษัทฯ บริษัทฯอาจเข้าถึง รวบรวมและประมวลผลข้อมูลเกี่ยวกับ
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <h2 class="font-bold"><u>ข้อจำกัดในการนำข้อมูลส่วนบุคคลไปใช้หรือเปิดเผย</u></h2>
                    <ol>
                        <li>1.บริษัทจะใช้ หรือเปิดเผย และแสดงข้อมูลของผู้สมัครงานเท่าที่จำเป็น ตามวัตถุประสงค์ของการเก็บรวบรวมข้อมูลส่วนบุคคลเท่านั้น โดยบริษัทจะกำกับดูแลพนักงาน หรือผู้ที่มีส่วนเกี่ยวข้องของบริษัทมิให้ใช้ หรือเปิดเผยข้อมูลของผู้สมัครงานให้แก่บุคคลภายนอก หรือบุคคลที่สามอย่างเคร่งครัด</li>
                        <li>2.บริษัทจะไม่เปิดเผยข้อมูล หรือแสดงข้อมูล หรือทำให้ปรากฏในส่วนอื่นใดของข้อมูลส่วนบุคคลที่ไม่สอดคล้องกับวัตถุประสงค์เท่าที่ได้รับความยินยอมจากผู้สมัครงาน ทั้งนี้บริษัทจะรักษาข้อมูลของผู้สมัครงานไว้เป็นความลับ เว้นแต่ที่กฎหมายกำหนด</li>
                        <li>3.บริษัทไม่มีนโยบายในการจำหน่าย แลกเปลี่ยน ถ่ายโอน หรือคัดลอกข้อมูลของผู้สมัครงานให้แก่บุคคลภายนอก และบุคคลที่สามที่ไม่มีส่วน เกี่ยวข้องตามแนวทางปฏิบัติในการคุ้มครองข้อมูลส่วนบุคคลของผู้สมัครงานไม่ว่าด้วยเหตุประการใด</li>
                        <li>4.บริษัทมีการจำกัดสิทธิในการเข้าถึง ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของผู้สมัครงานให้หน่วยงานและบุคคลภายในบริษัทเฉพาะที่เกี่ยวข้องเท่านั้น</li>
                    </ol>
                    <br>
                    <h2 class="font-bold"><u>สิทธิของเจ้าของข้อมูล</u></h2>
                    <p>
                        สิทธิของผู้สมัครงาน ซึ่งเป็นเจ้าของข้อมูลส่วนบุคคลตามพระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล พ.ศ. 2562 มีดังนี้
                    </p>
                    <ol>
                        <li>1.สิทธิได้รับการแจ้งให้ทราบ โดยได้รับการแจ้งเกี่ยวกับการประมวลผลข้อมูลส่วนบุคคล วิธีการเก็บรวบรวม บุคคลที่จะได้รับข้อมูล เหตุผล และระยะเวลาที่จัดเก็บ</li>
                        <li>2.สิทธิขอเข้าถึงและขอรับสำเนาข้อมูลส่วนบุคคลซึ่งอยู่ในความรับผิดชอบของบริษัท หรือขอให้เปิดเผยถึงการได้มาซึ่งข้อมูลส่วนบุคคลดังกล่าวที่ไม่ได้ให้ความยินยอม</li>
                        <li>3.สิทธิขอรับข้อมูลส่วนบุคคลที่เกี่ยวกับตนจากบริษัทโดยอัตโนมัติและขอให้ส่งหรือโอนข้อมูลส่วนบุคคลไปยังผู้ควบคุมข้อมูลส่วนบุคคลอื่นด้วยวิธีการอัตโนมัติ</li>
                        <li>4.สิทธิคัดค้านการเก็บรวบรวม ใช้หรือเปิดเผยข้อมูลส่วนบุคคลที่เกี่ยวกับเจ้าของข้อมูลส่วนบุคคล</li>
                        <li>5.สิทธิขอให้บริษัทดำเนินการลบหรือทำลาย หรือทำให้ข้อมูลส่วนบุคคลเป็นข้อมูลที่ไม่สามารถระบุตัวบุคคลที่เป็นเจ้าของข้อมูลส่วนบุคคลได้</li>
                        <li>6.สิทธิขอให้บริษัทระงับการใช้ข้อมูลส่วนบุคคลได้</li>
                        <li>7.สิทธิแก้ไขข้อมูลส่วนบุคคลให้ถูกต้อง โดยขอให้บริษัทดำเนินการแก้ไขเพิ่มเติมให้ข้อมูลส่วนบุคคลนั้นถูกต้องเป็นปัจจุบัน สมบูรณ์ และไม่ ก่อให้เกิดความเข้าใจผิด</li>
                        <li>8.สิทธิในการขอถอนความยินยอมซึ่งได้ให้ไว้กับบริษัทในการเก็บรวบรวม ประมวลผล ใช้ หรือเปิดเผยข้อมูลส่วนบุคคล</li>
                    </ol>
                    <p>
                        ทั้งนี้ผู้สมัครงานมีสิทธิที่จะยื่นคำขอใช้สิทธิร้องเรียนต่อบริษัท บางกรณีบริษัทอาจปฏิเสธการใช้สิทธิตามเหตุผลที่จะได้ แจ้งให้ทราบต่อไป ทั้งนี้ผู้สมัครงานสามารถร้องเรียนไปยังสำนักงานคณะกรรมการคุ้มครองข้อมูลส่วนบุคคล หากไม่เห็นด้วยกับเหตุผลที่บริษัทชี้แจง
                    </p>
                    <p>
                        การร้องขอใดๆเพื่อการใช้สิทธิตามที่กล่าวข้างต้น ผู้สมัครงานจะต้องกระทำเป็นลายลักษณ์อักษร และบริษัทจะใช้ความพยายามอย่างดีที่สุดที่จะดำเนินการหรือชี้แจงภายใน 30 วัน หรือไม่เกินตามระยะเวลาที่กฎหมายกำหนด โดยบริษัทจะปฏิบัติตามข้อกำหนดทางกฎหมายที่เกี่ยวข้องกับสิทธิของผู้สมัครงานในฐานะเจ้าของข้อมูลส่วนบุคคล ในกรณีที่ขอให้บริษัท ลบ ทำลาย กำจัดการประมวลผลข้อมูลส่วนบุคคล ระงับการใช้ชั่วคราว แปลง ข้อมูลส่วนบุคคลในรูปแบบข้อมูลที่ไม่สามารถระบุตัวตนเจ้าของ ข้อมูลส่วนบุคคลได้ หรือถอนความยินยอม อาจทำให้เกิดข้อจำกัดกับบริษัทในการดำเนินการตามกฎหมายที่เกี่ยวข้องได้ทั้งนี้ การใช้สิทธิดังกล่าวข้างต้น บริษัทขอสงวนสิทธิ์ในการคิดค่าใช้จ่ายที่เกี่ยวข้องและจำเป็นต่อการเข้าดำเนินการเกี่ยวกับข้อมูลส่วนบุคคลตามที่ผู้สมัครงานร้องขอ
                    </p>
                    <br>
                    <h2 class="font-bold">การติดต่อบริษัท</h2>
                    <p>
                        ผู้สมัครงานสามารถติดต่อกับเจ้าหน้าที่หน่วยงานทรัพยากรบุคคลของบริษัทในกรณีที่มีข้อสงสัย ข้อเสนอแนะ ตามความยินยอมในการเก็บ รวบรวม ประมวลผล ใช้ และ/หรือเปิดเผยข้อมูล หรือขอใช้สิทธิของเจ้าของข้อมูลส่วนบุคคลได้ที่
                    </p>
                    <p>เจ้าหน้าที่หน่วยงานทรัพยากรบุคคล</p>
                    <ul>
                        <li>บริษัท วี บียอนด์ ดีเวลอปเม้นท์ จํากัด (มหาชน)</li>
                        <li>อาคารเอ็มไพร์ทาวเวอร์ เลขที่1 ชั้น 24 ยูนิต 2401 ถนนสาทรใต้ แขวงยานนาวา เขตสาทร กรุงเทพมหานคร 10120</li>
                        <li>หมายเลขติดต่อ : 02-006-8008 (จันทร์ - ศุกร์ : เวลา 10.00 น. - 17.00 น. ยกเว้นวันหยุดราชการ)</li>
                        <li>อีเมล์ : hr@vbeyond.co.th</li>
                    </ul>
                    <p>
                        ข้าพเจ้าเจ้าของข้อมูลในฐานะผู้สมัครงาน ได้อ่าน และรับทราบข้อมูลข้างต้นแล้ว และยินยอมให้บริษัทเก็บรวบรวม ประมวลผล ใช้ และ/หรือ เปิดเผยข้อมูลส่วนบุคคลของข้าพเจ้า ตามหนังสือให้ความยินยอมการเก็บรวบรวม ประมวลผล ใช้ และ/หรือเปิดเผยข้อมูลส่วนบุคคลฉบับนี้
                    </p>

                </div>


                <!-- Section: Submit Button -->
                <div class="flex justify-center md:justify-end my-8">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-800 text-white px-8 py-2 rounded-full shadow hover:scale-105 transition font-semibold text-lg">
                        <i class="fa-solid fa-paper-plane mr-2"></i> ส่งใบสมัคร
                    </button>
                </div>
            </form>
        </div>

        <script>
            // Image Preview Handler
            const input = document.getElementById('image1');
            const preview = document.getElementById('preview');
            const placeholder = document.getElementById('image-placeholder');

            input.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    preview.src = URL.createObjectURL(this.files[0]);
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
            });

            const birthInput = document.getElementById("birthdate");
            const ageInput = document.getElementById("age");

            birthInput.addEventListener("change", function() {
                const birthDate = new Date(this.value);
                const today = new Date();

                let age = today.getFullYear() - birthDate.getFullYear();
                const m = today.getMonth() - birthDate.getMonth();

                // ถ้ายังไม่ถึงวันเกิดปีนี้ ให้ลบอายุออก 1 ปี
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }

                ageInput.value = age >= 0 ? age : '';
            });

            // Dynamic Education Table
            function addEduRow() {
                const template = document.getElementById('edu-row-template').content.cloneNode(true);
                if (template) {
                    template.querySelector('.remove-row-btn').onclick = function(e) {
                        const tbody = document.getElementById('edu-table-body');
                        // เช็คจำนวนแถว
                        if (tbody.querySelectorAll('tr').length > 1) {
                            e.target.closest('tr').remove();
                        }
                        // ถ้ามีแค่ 1 แถว ไม่ต้องลบ
                    };
                    document.getElementById('edu-table-body').appendChild(template);
                    updateRemoveBtnState();
                }
               
            }

            // ฟังก์ชันสำหรับซ่อน/โชว์ปุ่มลบ
            function updateRemoveBtnState() {
                const tbody = document.getElementById('edu-table-body');
                const rows = tbody.querySelectorAll('tr');
                rows.forEach(row => {
                    const btn = row.querySelector('.remove-row-btn');
                    if (rows.length === 0) {
                        btn.style.display = 'none'; // ซ่อนปุ่มลบถ้ามีแค่แถวเดียว
                    } else {
                        btn.style.display = '';
                    }
                });
            }

            // Add first row by default
            window.onload = () => {
                addEduRow();
            }; // เพิ่มในฟังก์ชัน addEduRow และหลังจากลบแถวเสร็จ

            //Thai ID Card Format
            function formatThaiID(input) {
                // ลบทุกตัวที่ไม่ใช่ตัวเลข
                let value = input.value.replace(/\D/g, '');

                // ตัดให้เหลือ 13 หลัก
                if (value.length > 13) value = value.substr(0, 13);

                // ใส่ขีดตามฟอร์แมต
                let formatted = value;
                if (value.length > 0) formatted = value.substr(0, 1);
                if (value.length > 1) formatted += '-' + value.substr(1, 4);
                if (value.length > 5) formatted += '-' + value.substr(5, 5);
                if (value.length > 10) formatted += '-' + value.substr(10, 2);
                if (value.length > 12) formatted += '-' + value.substr(12, 1);

                input.value = formatted;
            }

            // Salary
            function fnSalary() {
                return {
                    salary: '',
                    currentsalary: '',
                    formatNumber(value) {
                        const numeric = value.replace(/[^\d]/g, '');
                        return numeric.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                    }
                };
            }

            //Input file handler
            function fnDocuments(root) {
                const fileInput = root.querySelector('input[type="file"]');
                const filenameDisplay = root.querySelector('.filename');

                fileInput.addEventListener('change', () => {
                    const file = fileInput.files[0];
                    if (file) {
                        filenameDisplay.textContent = `: ${file.name}`;
                        filenameDisplay.classList.remove('hidden');
                    } else {
                        filenameDisplay.textContent = '';
                        filenameDisplay.classList.add('hidden');
                    }
                });
            }

            //name input formatter
            function fnNameInput(root) {
                const input = root.querySelector('input');
                const lang = input.dataset.lang;

                input.addEventListener('input', () => {
                    let val = input.value;

                    if (lang === 'thai') {
                        // อนุญาตเฉพาะอักษรไทยและเว้นวรรค
                        val = val.replace(/[^ก-๙\s]/g, '');
                    } else if (lang === 'english') {
                        // อนุญาตเฉพาะ a-z และเว้นวรรค และแปลงตัวแรกของคำเป็นพิมพ์ใหญ่
                        val = val.replace(/[^a-zA-Z\s]/g, '');
                        val = val.replace(/\b\w/g, l => l.toUpperCase());
                    }

                    input.value = val;
                });
            }

            // Function to handle the hasChildren checkbox
            function fnHasChildren() {
                return {
                    hasChildren: ''
                };
            }

            // Address handler
            function addressUser() {
                return {
                    sameAsRegistered: false,

                    // Address models
                    registered: {
                        address: '',
                        province: '',
                        district: '',
                        subdistrict: '',
                        postcode: ''
                    },
                    current: {
                        address: '',
                        province: '',
                        district: '',
                        subdistrict: '',
                        postcode: ''
                    },

                    // Dropdown lists
                    provinces: [],
                    provinces_curr: [],
                    amphoes: [],
                    amphoes_curr: [],
                    tambons: [],
                    tambons_curr: [],
                    zipcodes: [],
                    zipcodes_curr: [],

                    // Selected codes for dropdowns
                    selectedProvince: '',
                    selectedSecondProvince: '',
                    selectedAmphoe: '',
                    selectedSecondAmphoe: '',
                    selectedTambon: '',
                    selectedSecondTambon: '',

                    init() {
                        // Load province list on init
                        fetch("{{ url('api/provinces') }}")
                            .then(res => res.json())
                            .then(data => {
                                this.provinces = data;
                                this.provinces_curr = data; // For current address
                            });

                    
                        // Watch for "same as" toggle
                        this.$watch('sameAsRegistered', (value) => {
                            if (value) {
                                this.copyAddress();
                            } else {
                                this.clearCurrent();
                            }
                        });

                        // Watch any registered field changes and sync
                        // this.$watch('registered', () => {
                        //     if (this.sameAsRegistered) {
                        //         this.copyAddress();
                        //     }
                        // }, { deep: true });
                    },

                    loadAmphoes() {
                        this.amphoes = [];
                        this.tambons = [];
                        this.zipcodes = [];
                        this.selectedAmphoe = '';
                        this.selectedTambon = '';
                        this.registered.district = '';
                        this.registered.subdistrict = '';
                        this.registered.postcode = '';

                        // Set province name
                        const selectProvince = this.provinces.find(p => p.province == this.selectedProvince);
                        
                        this.registered.province = selectProvince ? selectProvince.province : '';

                        fetch(`{{ url('api/amphoes') }}?province=${this.selectedProvince}`)
                            .then(res => res.json())
                            .then(data => {
                                this.amphoes = data;
                                this.amphoes_curr = data; // For current address
                            });
                    },

                    loadAmphoesCurr(){
                        this.amphoes_curr = [];
                        this.tambons_curr = [];
                        this.zipcodes_curr = [];
                        this.selectedSecondAmphoe = '';
                        this.selectedSecondTambon = '';
                        this.current.district = '';
                        this.current.subdistrict = '';
                        this.current.postcode = '';

                        // Set province name
                        const selectSecondProvince = this.provinces_curr.find(p => p.province == this.selectedSecondProvince);
                        console.log('Selected Province:', selectSecondProvince);
                        
                        if (this.sameAsRegistered == false) {
                            this.current.province = selectSecondProvince ? selectSecondProvince.province : '';
                            console.log('Current Province:', this.current.province);
                            
                        }

                        fetch(`{{ url('api/amphoes') }}?province=${this.selectedSecondProvince}`)
                            .then(res => res.json())
                            .then(data => this.amphoes_curr = data);
                    },

                    loadTambons() {
                        this.tambons = [];
                        this.zipcodes = [];
                        this.selectedTambon = '';
                        this.registered.subdistrict = '';
                        this.registered.postcode = '';

                        // Set amphoe name
                        const selectAmphoe = this.amphoes.find(a => a.amphoe == this.selectedAmphoe);
                        console.log('Selected Amphoe:',  selectAmphoe);
                        
                        this.registered.district = selectAmphoe ? selectAmphoe.amphoe : '';

                        fetch(`{{ url('api/tambons') }}?province=${this.selectedProvince}&amphoe=${this.selectedAmphoe}`)
                            .then(res => res.json())
                            .then(data => this.tambons = data);
                    },

                    loadTambonsCurr() {
                        this.tambons_curr = [];
                        this.zipcodes_curr = [];
                        this.selectedSecondTambon = '';
                        this.current.subdistrict = '';
                        this.current.postcode = '';

                        // Set amphoe name
                        const selectSecondAmphoe = this.amphoes_curr.find(a => a.amphoe == this.selectedSecondAmphoe);
                        console.log('Selected Amphoe:',  selectSecondAmphoe);
                        
                        if (this.sameAsRegistered == false) {
                            this.current.district = selectSecondAmphoe ? selectSecondAmphoe.amphoe : '';
                        }

                        fetch(`{{ url('api/tambons') }}?province=${this.selectedSecondProvince}&amphoe=${this.selectedSecondAmphoe}`)
                            .then(res => res.json())
                            .then(data => this.tambons_curr = data);
                    },

                    loadZipcode() {
                        this.registered.postcode = '';

                        // Set tambon name
                        const selectTambon = this.tambons.find(t => t.tambon == this.selectedTambon);
                        this.registered.subdistrict = selectTambon ? selectTambon.tambon : '';

                        fetch(`{{ url('api/zipcodes') }}?province=${this.selectedProvince}&amphoe=${this.selectedAmphoe}&tambon=${this.selectedTambon}`)
                            .then(res => res.json())
                            .then(data => {
                                if (data.length > 0) {
                                    this.registered.postcode = data[0].zipcode;
                                }
                            });
                    },

                    loadZipcodeCurr() {
                        this.current.postcode = '';

                        // Set tambon name
                        const selectSecondTambon = this.tambons_curr.find(t => t.tambon == this.selectedSecondTambon);
                        this.current.subdistrict = selectSecondTambon ? selectSecondTambon.tambon : '';

                        fetch(`{{ url('api/zipcodes') }}?province=${this.selectedSecondProvince}&amphoe=${this.selectedSecondAmphoe}&tambon=${this.selectedSecondTambon}`)
                            .then(res => res.json())
                            .then(data => {
                                if (data.length > 0) {
                                    this.current.postcode = data[0].zipcode;
                                }
                            });
                    },

                    copyAddress() {
                        this.current = { ...this.registered };
                        console.log('Copying address:', this.current);
                        
                    },

                    clearCurrent() {
                        this.current = {
                            address: '',
                            province: '',
                            district: '',
                            subdistrict: '',
                            postcode: ''
                        };
                    },
                    
                }
            }


            // Phone number formatter
            function phoneFormat() {
                return {
                    phone: '',
                    formatPhone(value) {
                        value = value.replace(/\D/g, '');
                        if (value.length > 10) value = value.slice(0, 10);

                        // จัดรูปแบบ xxx-xxx-xxxx
                        if (value.length > 6) {
                            return value.slice(0, 3) + '-' + value.slice(3, 6) + '-' + value.slice(6);
                        } else if (value.length > 3) {
                            return value.slice(0, 3) + '-' + value.slice(3);
                        } else {
                            return value;
                        }
                    }
                };
            }

            // Education 
            function educationHandler() {
                return {
                    educations: [{
                        level: '',
                        school: '',
                        country: '',
                        program: '',
                        major: '',
                        gpa: '',
                        graduate_year: ''
                    }],
                    addRow() {
                        this.educations.push({
                            level: '',
                            school: '',
                            country: '',
                            program: '',
                            major: '',
                            gpa: '',
                            graduate_year: ''
                        });
                    },
                    removeRow(idx) {
                        if (this.educations.length > 1) {
                            this.educations.splice(idx, 1);
                        }
                    },
                    formatGPA(value) {
                        if (value) {
                           let num = parseFloat(value.replace(/[^0-9.]/g, ''));
                            if (isNaN(num)) return '';
                            if (num > 4) num = 4.00;
                            return num.toFixed(2); 
                        }
                        
                    }
                    // formatGPA(value) {
                    //     if (!value) return '';
                    //     value = value.toString().replace(/[^0-9.]/g, '');
                    //     const parts = value.split('.');
                    //     let numStr = parts[0];
                    //     if (parts.length > 1) {
                    //         numStr += '.' + parts[1].slice(0, 2);
                    //     }

                    //     let num = parseFloat(numStr);
                    //     if (isNaN(num)) return '';
                    //     if (num > 4) num = 4.00;
                    //     return num.toFixed(2);
                    // }

                };
            }

            // University Name Autocomplete ยังใช้ไม่ได้
            function universityAutocomplete() {
                return {
                    query: '',
                    universities: [],
                    filtered: [],
                    show: false,

                    async loadUniversities() {
                        // try {
                        //     const res = await fetch('http://202.44.139.145/api/public/opendata/univ_uni_11_03_2563');
                        //     const data = await res.json();
                        //     this.universities = [...new Set(data.map(u => u.UNIV_NAME))]; // ลบชื่อซ้ำ
                        // } catch (error) {
                        //     console.error('โหลดรายชื่อมหาวิทยาลัยไม่สำเร็จ:', error);
                        // }
                    },

                    filterUniversities() {
                        const term = this.query.toLowerCase();
                        this.filtered = this.universities
                            .filter(name => name.toLowerCase().includes(term))
                            .slice(0, 10);
                        this.show = true;
                    },

                    selectUniversity(name) {
                        this.query = name;
                        this.show = false;
                    }
                }
            }

            // Computer Skills Handler
            function fnComputerSkills() {
                return {
                    programs: [{
                        name: '',
                        level: ''
                    }],
                    addProgram() {
                        this.programs.push({
                            name: '',
                            level: ''
                        });
                    },
                    removeProgram(idx) {
                        if (this.programs.length > 1) {
                            this.programs.splice(idx, 1);
                        }
                    }
                };
            }

            // Language Skills Handler
            function fnLanguageSkills() {
                return {
                    langs: [{
                            name: 'ภาษาไทย',
                            level: '',
                            file: null
                        },
                        {
                            name: 'ภาษาอังกฤษ',
                            level: '',
                            file: null
                        }
                    ],
                    isDefaultLanguage(idx) {
                        return idx === 0 || idx === 1;
                    },
                    addLang() {
                        this.langs.push({
                            name: '',
                            level: '',
                            file: null
                        });
                    },
                    removeLang(idx) {
                        if (this.langs.length > 2) {
                            this.langs.splice(idx, 1);
                        }
                    },
                    uploadFile(event, idx) {
                        const file = event.target.files[0];
                        if (file) {
                            this.langs[idx].file = file;
                        }
                    }
                };
            }

            // fnTraining
            function fnTraining() {
                return {
                    trainings: [{
                        year: '',
                        duration: '',
                        topic: '',
                        institution: ''
                    }],
                    addRow() {
                        this.trainings.push({
                            year: '',
                            duration: '',
                            topic: '',
                            institution: ''
                        });
                    },
                    removeRow(idx) {
                        if (this.trainings.length > 1) this.trainings.splice(idx, 1);
                    }
                }
            }

            // Work Experience Handler
            function fnWorkExperience() {
                return {
                    works: [{
                        company: '',
                        position: '',
                        responsibility: '',
                        duration: '',
                        currentsalary: '',
                        otherIncome: '',
                        reason: ''
                    }],
                    addRow() {
                        this.works.push({
                            company: '',
                            position: '',
                            responsibility: '',
                            duration: '',
                            currentsalary: '',
                            otherIncome: '',
                            reason: ''
                        });
                    },
                    removeRow(idx) {
                        if (this.works.length > 1) this.works.splice(idx, 1);
                    },
                    formatNumber(value) {
                        const numeric = value.replace(/[^\d]/g, '');
                        return numeric.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                    }
                };
            }
            function modalAgreement() {
                return {
                    show: false,
                    current: '',
                    modalTitle: '',
                    modalContent: '',
                    openModal(type) {
                        this.current = type;
                        this.show = true;

                        if (type === 'tos') {
                            this.modalTitle = 'เงื่อนไขการให้บริการ';
                            this.modalContent = `
                                <p>รายละเอียดของเงื่อนไขการให้บริการ...</p>
                                <p>คุณต้องยอมรับเพื่อดำเนินการต่อ</p>
                            `;
                        } else if (type === 'privacy') {
                            this.modalTitle = 'นโยบายความเป็นส่วนตัว';
                            // document.getElementById('pdpaContent').style.display = 'block';
                            this.modalContent = document.getElementById('pdpaContent').innerHTML;
                            // this.modalContent = `
                            //     <p>รายละเอียดของนโยบายความเป็นส่วนตัว...</p>
                            //     <p>เราเคารพข้อมูลของคุณ</p>
                            // `;
                        }
                    },
                    closeModal() {
                        this.show = false;
                        this.modalContent = '';
                    },
                    accept() {
                        document.getElementById(this.current).checked = true;
                        this.closeModal();
                    }
                };
            }
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const accordionItems = document.querySelectorAll('.accordion-item');

                accordionItems.forEach(item => {
                    const button = item.querySelector('.accordion-button');
                    const content = item.querySelector('.accordion-content');
                    const icon = button.querySelector('svg:last-child');

                    button.addEventListener('click', () => {
                        const isExpanded = content.style.maxHeight && content.style.maxHeight !== '0px';

                        if (isExpanded) {
                            content.style.maxHeight = '0px';
                            icon.style.transform = 'rotate(0deg)';
                        } else {
                            content.style.maxHeight = content.scrollHeight + 'px';
                            icon.style.transform = 'rotate(180deg)';
                        }
                    });
                });

                const consentButton = document.getElementById('consent-button');
                const modal = document.getElementById('consent-modal');
                const closeModalButton = document.getElementById('close-modal-button');

                consentButton.addEventListener('click', () => {
                    modal.classList.remove('hidden');
                });

                closeModalButton.addEventListener('click', () => {
                    modal.classList.add('hidden');
                });

                modal.addEventListener('click', (event) => {
                    if (event.target === modal) {
                        modal.classList.add('hidden');
                    }
                });
            });
        </script>
        <script src="//unpkg.com/alpinejs" defer></script>
    </body>
@endsection
