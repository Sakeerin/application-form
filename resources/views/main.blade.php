@extends('layouts.app')

@section('title', 'Register')

@section('content')

    <body class="bg-gray-50 min-h-screen overflow-auto md:py-10">
        <div class="max-w-4xl mx-auto space-y-10">

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
                                <img x-show="previewUrl" :src="previewUrl" id="preview"
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
                                <option value="sale">Sale</option>
                                <option value="admin">Admin</option>
                                <option value="it">IT Support</option>
                                <option value="programmer">Programmer</option>
                                <option value="advertising">Advertising Manager</option>
                                <option value="bd">Business Development</option>
                                <option value="sustainable">Sustainable Development </option>
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
                            <input type="number" name="age" id="age" readonly disabled placeholder="--"
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
                                <input type="radio" id="military_pending" name="militaryStatus"
                                    class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                ยังไม่ได้รับการเกณฑ์ทหาร
                            </label>

                            <label class="flex items-center gap-2" for="military_done">
                                <input type="radio" id="military_done" name="militaryStatus"
                                    class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                ผ่านการเกณฑ์ทหารแล้ว
                            </label>

                            <label class="flex items-center gap-2" for="military_serving">
                                <input type="radio" id="military_serving" name="militaryStatus"
                                    class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                รับราชการทหารแล้ว
                            </label>

                            <label class="flex items-center gap-2" for="military_exempted">
                                <input type="radio" id="military_exempted" name="militaryStatus"
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
                            <label class="flex items-center gap-2"><input type="radio" id="single" name="status"
                                    class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                โสด</label>
                            <label class="flex items-center gap-2"><input type="radio" id="married" name="status"
                                    class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                สมรส</label>
                            <label class="flex items-center gap-2"><input type="radio" id="widowed" name="status"
                                    class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                หม้าย</label>
                            <label class="flex items-center gap-2"><input type="radio" id="divorced" name="status"
                                    class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                หย่าร้าง</label>
                        </div>
                        <!-- Section: ท่านมีบุตรหรือไม่ -->
                        <label class="block text-gray-700 font-semibold mb-1">ท่านมีบุตรหรือไม่ :</label>
                        <div x-data="fnHasChildren()" class="mb-2">

                            <div class="flex gap-4">
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="hasChildren" value="yes" x-model="hasChildren"
                                        class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                    มี
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="hasChildren" value="no" x-model="hasChildren"
                                        class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                    ไม่มี
                                </label>
                            </div>

                            <!-- ช่องใส่จำนวนบุตร -->
                            <div x-show="hasChildren === 'yes'" x-transition class="mt-2">
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
                            <div class="flex flex-col gap-y-2 md:mt-0">
                                <label for="dad_alive" class="flex items-center gap-2">
                                    <input type="radio" id="dad_alive" name="dadalive" value="yes"
                                        class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                    <span class="text-gray-700 font-medium">มีชีวิตอยู่</span>
                                </label>
                                <label for="dad_deceased" class="flex items-center gap-2">
                                    <input type="radio" id="dad_deceased" name="dadalive" value="no"
                                        class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                    <span class="text-gray-700 font-medium">ถึงแก่กรรม</span>
                                </label>
                            </div>

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
                            <div class="flex flex-col gap-y-2 md:mt-0">
                                <label for="mom_alive" class="flex items-center gap-2">
                                    <input type="radio" id="mom_alive" name="momalive" value="yes"
                                        class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                    <span class="text-gray-700 font-medium">มีชีวิตอยู่</span>
                                </label>
                                <label for="mom_deceased" class="flex items-center gap-2">
                                    <input type="radio" id="mom_deceased" name="momalive" value="no"
                                        class="w-[15px] h-[15px] accent-green-600 cursor-pointer">
                                    <span class="text-gray-700 font-medium">ถึงแก่กรรม</span>
                                </label>
                            </div>
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
                    <div x-data="addressHandler()" x-init="init()">
                        <!-- Section: ที่อยู่ตามทะเบียนบ้าน -->
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="address" class="block text-gray-700 font-semibold mb-1">ที่อยู่ตามทะเบียนบ้าน
                                    <span class="text-red-500">*</span></label>
                                <input type="text" id="address" x-model="registered.address" required
                                    class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50"
                                    placeholder="เลขที่/หมู่บ้าน/ซอย/ถนน">
                            </div>
                            <div>
                                <label for="province" class="block text-gray-700 font-semibold mb-1">จังหวัด <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="province" x-model="registered.province" required
                                    class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                            </div>
                            <div>
                                <label for="district" class="block text-gray-700 font-semibold mb-1">อำเภอ/เขต <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="district" x-model="registered.district" required
                                    class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                            </div>
                            <div>
                                <label for="subdistrict" class="block text-gray-700 font-semibold mb-1">ตำบล/แขวง <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="subdistrict" x-model="registered.subdistrict" required
                                    class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                            </div>
                            <div>
                                <label for="postcode" class="block text-gray-700 font-semibold mb-1">รหัสไปรษณีย์ <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="postcode" x-model="registered.postcode" required
                                    class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
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
                                <div>
                                    <label for="curr_address"
                                        class="block text-gray-700 font-semibold mb-1">ที่อยู่ปัจจุบัน
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="curr_address" x-model="current.address" required
                                        :readonly="sameAsRegistered"
                                        class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50"
                                        placeholder="เลขที่/หมู่บ้าน/ซอย/ถนน">
                                </div>
                                <div>
                                    <label for="curr_province" class="block text-gray-700 font-semibold mb-1">จังหวัด
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="curr_province" x-model="current.province" required
                                        :readonly="sameAsRegistered"
                                        class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                                </div>
                                <div>
                                    <label for="curr_district" class="block text-gray-700 font-semibold mb-1">อำเภอ/เขต
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="curr_district" x-model="current.district" required
                                        :readonly="sameAsRegistered"
                                        class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                                </div>
                                <div>
                                    <label for="curr_subdistrict" class="block text-gray-700 font-semibold mb-1">ตำบล/แขวง
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="curr_subdistrict" x-model="current.subdistrict" required
                                        :readonly="sameAsRegistered"
                                        class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                                </div>
                                <div>
                                    <label for="curr_postcode" class="block text-gray-700 font-semibold mb-1">รหัสไปรษณีย์
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="curr_postcode" x-model="current.postcode" required
                                        :readonly="sameAsRegistered"
                                        class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
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
                                        class="block text-sm font-medium text-gray-700 mb-1">ระดับการศึกษา</label>
                                    <select name="edu_level" id="edu_level"
                                        class="w-full border focus:ring-2 focus:ring-green-400 rounded-lg px-2 py-1 h-10 bg-gray-50"
                                        x-model="edu.level">
                                        <option value="" disabled selected>เลือกระดับ</option>
                                        <option value="doctorate">ปริญญาเอก</option>
                                        <option value="master">ปริญญาโท</option>
                                        <option value="bachelor">ปริญญาตรี</option>
                                        <option value="associate">อนุปริญญา</option>
                                        <option value="vocational_diploma">ปวส.</option>
                                        <option value="vocational_certificate">ปวช.</option>
                                        <option value="high_school">มัธยมศึกษา</option>
                                    </select>
                                </div>

                                <!-- ชื่อสถานศึกษา -->
                                {{-- <div x-data="universityAutocomplete()" class="col-span-1 sm:col-span-2 lg:col-span-2">
                                    <label for="edu_name"
                                        class="block text-sm font-medium text-gray-700 mb-1">ชื่อสถานศึกษา</label>
                                    <input type="text" name="edu_name" id="edu_name"
                                        class="w-full border focus:ring-2 focus:ring-green-400 rounded-lg h-10 px-2 py-1 bg-gray-50"
                                        x-model="edu.school">
                                </div> --}}

                                <div class="col-span-1 sm:col-span-2 lg:col-span-2 relative" x-data="universityAutocomplete()"
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
                                </div>


                                <!-- ประเทศ -->
                                <div>
                                    <label for="edu_country"
                                        class="block text-sm font-medium text-gray-700 mb-1">ประเทศ</label>
                                    <input type="text" name="edu_country" id="edu_country"
                                        class="w-full border focus:ring-2 focus:ring-green-400 rounded-lg h-10 px-2 py-1 bg-gray-50"
                                        x-model="edu.country">
                                </div>

                                <!-- หลักสูตร -->
                                <div>
                                    <label for="edu_program"
                                        class="block text-sm font-medium text-gray-700 mb-1">หลักสูตร/ชื่อปริญญา</label>
                                    <input type="text" name="edu_program" id="edu_program"
                                        class="w-full border focus:ring-2 focus:ring-green-400 rounded-lg h-10 px-2 py-1 bg-gray-50"
                                        x-model="edu.program">
                                </div>

                                <!-- สาขาวิชา -->
                                <div>
                                    <label for="edu_major"
                                        class="block text-sm font-medium text-gray-700 mb-1">สาขาวิชา</label>
                                    <input type="text" name="edu_major" id="edu_major"
                                        class="w-full border focus:ring-2 focus:ring-green-400 rounded-lg h-10 px-2 py-1 bg-gray-50"
                                        x-model="edu.major">
                                </div>

                                <!-- เกรดเฉลี่ย -->
                                <div x-data="formatGPA()">
                                    <label for="edu_gpx"
                                        class="block text-sm font-medium text-gray-700 mb-1">เกรดเฉลี่ย</label>
                                    <input type="text" name="edu_gpx" id="edu_gpx"
                                        class="w-full border focus:ring-2 focus:ring-green-400 rounded-lg h-10 px-2 py-1 bg-gray-50"
                                        x-model="edu.gpa" @blur="edu.gpa = formatGPA(edu.gpa)" inputmode="decimal"
                                        maxlength="4">
                                </div>


                                <!-- ปีที่จบ -->
                                <div>
                                    <label for="edu_gradyear"
                                        class="block text-sm font-medium text-gray-700 mb-1">ปีที่สำเร็จการศึกษา</label>
                                    <input type="text" name="edu_gradyear" id="edu_gradyear"
                                        class="w-full border focus:ring-2 focus:ring-green-400 rounded-lg h-10 px-2 py-1 bg-gray-50"
                                        x-model="edu.graduate_year">
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
                                        <input type="radio" name="travel" id="travel_yes" value="yes"
                                            class="accent-green-600 w-4 h-4" x-model="travel">
                                        <span>สะดวก</span>
                                    </label>

                                    <label for="travel_no" class="inline-flex items-center gap-2 md:mr-20">
                                        <input type="radio" name="travel" id="travel_no" value="no"
                                            class="accent-green-600 w-4 h-4" x-model="travel">
                                        <span>ไม่สะดวก</span>
                                    </label>

                                    <label for="travel_sometimes" class="inline-flex items-center gap-2">
                                        <input type="radio" name="travel" id="travel_sometimes" value="sometimes"
                                            class="accent-green-600 w-4 h-4" x-model="travel">
                                        <span>บางครั้ง</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Row 2 ความสามารถด้านคอมพิวเตอร์ -->
                        <div x-data="fnComputerSkills()" class="bg-gray-50 p-4 rounded-lg mb-4">
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
                                    <input type="radio" name="typing_speed" id="typing_exc" value="excellent"
                                        class="accent-green-600 w-4 h-4" x-model="typing">
                                    <span>ดีมาก</span>
                                </label>
                                <label for="typing_good" class="inline-flex items-center gap-2 ml-4  md:mr-20">
                                    <input type="radio" name="typing_speed" id="typing_good" value="good"
                                        class="accent-green-600 w-4 h-4" x-model="typing">
                                    <span>ดี</span>
                                </label>
                                <label for="typing_fair" class="inline-flex items-center gap-2 ml-4  md:mr-20">
                                    <input type="radio" name="typing_speed" id="typing_fair" value="fair"
                                        class="accent-green-600 w-4 h-4" x-model="typing">
                                    <span>ปานกลาง</span>
                                </label>
                                <label for="typing_no" class="inline-flex items-center gap-2 ml-4">
                                    <input type="radio" name="typing_speed" id="typing_no" value="no"
                                        class="accent-green-600 w-4 h-4" x-model="typing">
                                    <span>ไม่ได้เลย</span>
                                </label>
                            </div>
                        </div>

                        <!-- Row 3 ความสามารถด้านภาษา -->
                        <div x-data="fnLanguageSkills()" class="bg-gray-50 p-4 rounded-lg">
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
                                                <input type="file" class="hidden" @change="uploadFile($event, idx)">
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
                                        <label class="block text-sm font-medium text-gray-700 mb-1">สถานที่ทำงาน <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="work_company" required x-model="work.company"
                                            class="w-full h-10 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-green-400 rounded-lg px-2 py-1"
                                            placeholder="บริษัท เอบีซี จำกัด">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">ตำแหน่ง <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="work_position" required x-model="work.position"
                                            class="w-full h-10 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-green-400 rounded-lg px-2 py-1"
                                            placeholder="ตำแหน่งงานที่ทำ">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">งานที่รับผิดชอบ <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="work_respon" required x-model="work.responsibility"
                                        class="w-full h-10 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-green-400 rounded-lg px-2 py-1"
                                        placeholder="เช่น ดูแลระบบ, เขียนโปรแกรม, ประสานงาน ฯลฯ">
                                </div>

                                <div class="grid grid-cols-3 gap-4 items-end">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">ระยะเวลาการทำงาน <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="work_duration" required x-model="work.duration"
                                            class="w-full h-10 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-green-400 rounded-lg px-2 py-1"
                                            placeholder="เช่น 1 ปี 10 เดือน">
                                    </div>
                                    <div x-data="fnSalary()">
                                        <label for="currentsalary"
                                            class="block text-sm font-medium text-gray-700 mb-1">เงินเดือนล่าสุด <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" id="currentsalary" name="currentsalary" required
                                            x-model="currentsalary"
                                            @input="currentsalary = formatNumber($event.target.value)" inputmode="numeric"
                                            class="w-full h-10 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-green-400 rounded-lg px-2 py-1"
                                            placeholder="เช่น 30,000">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">รายได้อื่น ๆ</label>
                                        <input type="text" name="work_income" x-model="work.otherIncome"
                                            class="w-full h-10 border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-green-400 rounded-lg px-2 py-1"
                                            placeholder="ระบุเป็นตัวเลข">
                                    </div>
                                </div>

                                <div class="grid md:grid-cols-[83%_15%] gap-4 items-end">
                                    <div class="flex items-end">
                                        <div class="flex-1">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">สาเหตุที่ออก <span
                                                    class="text-red-500">*</span></label>
                                            <input type="text" name="work_reason" required x-model="work.reason"
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
                                            value="ไม่เคย">
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
                                            value="ไม่เคย">
                                        ไม่เคย</label>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <p class="font-medium text-gray-800">4. ท่านเคยต้องโทษหรือต้องคดีอาญาหรือไม่</p>
                                <div class="flex gap-4">
                                    <label for="q4_yes"><input type="radio" id="q4_yes" name="q4"
                                            value="เคย"> เคย</label>
                                    <label for="q4_no"><input type="radio" id="q4_no" name="q4"
                                            value="ไม่เคย">
                                        ไม่เคย</label>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <p class="font-medium text-gray-800">5. ท่านเคยเสพสิ่งเสพติดหรือของมึนเมาหรือไม่</p>
                                <div class="flex gap-4">
                                    <label for="q5_yes"><input type="radio" id="q5_yes" name="q5"
                                            value="เคย"> เคย</label>
                                    <label for="q5_no"><input type="radio" id="q5_no" name="q5"
                                            value="ไม่เคย">
                                        ไม่เคย</label>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <p class="font-medium text-gray-800">6. ท่านไม่ใช่บุคคลตั้งครรภ์ใช่หรือไม่</p>
                                <div class="flex gap-4">
                                    <label for="q6_yes"><input type="radio" id="q6_yes" name="q6"
                                            value="ใช่"> ใช่</label>
                                    <label for="q6_no"><input type="radio" id="q6_no" name="q6"
                                            value="ไม่ใช่">
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
                                            value="ไม่เคย">
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
                                            value="เคย"> เคย</label>
                                    <label for="q8_no"><input type="radio" id="q8_no" name="q8"
                                            value="ไม่เคย">
                                        ไม่เคย</label>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <p class="font-medium text-gray-800">9. ท่านยอมรับการทดลองงาน 119 วันหรือไม่</p>
                                <div class="flex gap-4">
                                    <label for="q9_yes"><input type="radio" id="q9_yes" name="q9"
                                            value="ยอมรับ">
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
                                            value="ไม่เคย">
                                        ไม่เคย</label>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <p class="font-medium text-gray-800">11. ท่านมีภาระค่าใช้จ่ายในครอบครัวหรือไม่</p>
                                <div class="flex gap-4">
                                    <label for="q11_yes"><input type="radio" id="q11_yes" name="q11"
                                            value="มี"> มี</label>
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
                                            value="ไม่เคย">
                                        ไม่เคย</label>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <p class="font-medium text-gray-800">13. ในครอบครัวท่านเคยมีโรคติดต่อร้ายแรงหรือไม่</p>
                                <div class="flex gap-4">
                                    <label for="q13_yes"><input type="radio" id="q13_yes" name="q13"
                                            value="มี"> มี</label>
                                    <label for="q13_no"><input type="radio" id="q13_no" name="q13"
                                            value="ไม่มี">
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
                                <input type="text" id="phone_2" name="phone_2" x-model="phone"
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
                                <input type="date" name="detail_2" :min="today" required
                                    class="w-full h-10 border border-gray-300 rounded-lg px-3 focus:ring-2 focus:ring-green-400 bg-gray-50">
                            </div>
                        </div>
                    </div>

                    <!-- Section: เงื่อนไขการให้บริการและข้อมูลส่วนบุคคล -->
                    <div class="p-8">
                        <div class="grid justify-center gap-2 items-center">
                            <!-- Checkbox: เงื่อนไขการให้บริการ -->
                            <div class="flex items-center justify-start mb-3 flex-wrap text-sm text-gray-700">
                                <input type="checkbox" id="tos" name="tos" value="เงื่อนไขการให้บริการ"
                                    required class="accent-green-600 w-4 h-4">
                                <label for="tos" class="ml-2">ยอมรับ</label>
                                <a target="_blank" class="ml-1 text-blue-600 hover:underline">
                                    เงื่อนไขการให้บริการ
                                </a>
                            </div>
                            <!-- Checkbox: นโยบายความเป็นส่วนตัว -->
                            <div class="flex items-center justify-start mb-2 flex-wrap text-sm text-gray-700">
                                <input type="checkbox" id="privacy_1" name="privacy_1" value="นโยบายความเป็นส่วนตัว"
                                    required class="accent-green-600 w-4 h-4">
                                <label for="privacy_1" class="ml-2">ยอมรับ</label>
                                <a target="_blank" class="ml-1 text-blue-600 hover:underline">
                                    นโยบายความเป็นส่วนตัว
                                </a>
                            </div>
                        </div>
                    </div>
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

            // Salary input formatter
            // ใช้สำหรับเงินเดือนและรายได้อื่น ๆ
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
            function addressHandler() {
                return {
                    sameAsRegistered: false,
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
                    init() {
                        // Sync เริ่มต้นเมื่อกด checkbox
                        this.$watch('sameAsRegistered', (value) => {
                            if (value) {
                                this.copyAddress();
                            } else {
                                this.clearCurrent();
                            }
                        });

                        // เฝ้าดูทุก key ของ registered แล้ว sync แบบ realtime ถ้า sameAsRegistered ถูกเลือก
                        this.$watch('registered', (value) => {
                            if (this.sameAsRegistered) {
                                this.copyAddress();
                            }
                        }, {
                            deep: true
                        });
                    },
                    copyAddress() {
                        this.current = {
                            ...this.registered
                        };
                    },
                    clearCurrent() {
                        this.current = {
                            address: '',
                            province: '',
                            district: '',
                            subdistrict: '',
                            postcode: ''
                        };
                    }
                };
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
                        let num = parseFloat(value.replace(/[^0-9.]/g, ''));
                        if (isNaN(num)) return '';
                        if (num > 4) num = 4.00;
                        return num.toFixed(2);
                    }
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
                        try {
                            const res = await fetch('http://202.44.139.145/api/public/opendata/univ_uni_11_03_2563');
                            const data = await res.json();
                            this.universities = [...new Set(data.map(u => u.UNIV_NAME))]; // ลบชื่อซ้ำ
                        } catch (error) {
                            console.error('โหลดรายชื่อมหาวิทยาลัยไม่สำเร็จ:', error);
                        }
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
                        salary: '',
                        otherIncome: '',
                        totalIncome: '',
                        reason: ''
                    }],
                    addRow() {
                        this.works.push({
                            company: '',
                            position: '',
                            responsibility: '',
                            duration: '',
                            salary: '',
                            otherIncome: '',
                            totalIncome: '',
                            reason: ''
                        });
                    },
                    removeRow(idx) {
                        if (this.works.length > 1) this.works.splice(idx, 1);
                    }
                };
            }

            function fnSalary() {
                return {
                    currentsalary: '',
                    formatNumber(value) {
                        value = value.replace(/[^\d]/g, '');
                        return new Intl.NumberFormat().format(value);
                    }
                };
            }
        </script>
        <script src="//unpkg.com/alpinejs" defer></script>
    </body>
@endsection
