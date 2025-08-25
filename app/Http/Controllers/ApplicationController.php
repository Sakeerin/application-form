<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ApplicationController extends Controller
{
    public function index(){
        try {
            $apiVBnext = env('API_VBNEXT');
            $apiToken = env('API_TOKEN_AUTH');
            $url = "{$apiVBnext}/hr/getPositionApply";

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken
            ])->post($url);

            if ($response->successful()) {
                $position = json_decode($response->getBody(), true);
            } else {
                $position = [];
            }

            return view('main', [
                'positions' => $position['data'],
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }

    public function store(Request $request){
        // dd($request->all());
        // dd($request->getSchemeAndHttpHost());
        try {
            $datetime = now()->format('Y-m-d H:i:s');
            $apply = new Application();
            $apply->position = $request->input('position');
            $apply->salary = $request->input('salary');
            // file img user
            if ($request->hasFile('img_user')) {
                $img_user = $request->file('img_user');
                $extension = $img_user->getClientOriginalExtension();
                $filename = now()->format('Ymd_His') . '_' . uniqid() . '.' . $extension;
                $img_user->move('uploads/files/file_users', $filename);
                $apply->img_user = 'uploads/files/file_users/' . $filename; 
            } else {
                $apply->img_user = null; 
            }
            // file house
            if ($request->hasFile('file_house')) {
                $file_house = $request->file('file_house');
                $extension = $file_house->getClientOriginalExtension();
                $filename = now()->format('Ymd_His') . '_' . uniqid() . '.' . $extension;
                $file_house->move('uploads/files/file_house', $filename);
                $apply->file_house = 'uploads/files/file_house/'. $filename; 
            } else {
                $apply->file_house = null; 
            }
            // file id card
            if ($request->hasFile('file_id')) {
                $file_id_card = $request->file('file_id');
                $extension = $file_id_card->getClientOriginalExtension();
                $filename = now()->format('Ymd_His') . '_' . uniqid() . '.' . $extension;
                $file_id_card->move('uploads/files/file_id_card', $filename);
                $apply->file_id_card = 'uploads/files/file_id_card/'. $filename; 
            } else {
                $apply->file_id_card = null; 
            }
            // file education
            if ($request->hasFile('file_edu')) {
                $file_education = $request->file('file_edu');
                $extension = $file_education->getClientOriginalExtension();
                $filename = now()->format('Ymd_His') . '_' . uniqid() . '.' . $extension;
                $file_education->move('uploads/files/file_education', $filename);
                $apply->file_education = 'uploads/files/file_education/'. $filename; 
            } else {
                $apply->file_education = null; 
            }
            // file cv
            if ($request->hasFile('file_cv')) {
                $file_cv = $request->file('file_cv');
                $extension = $file_cv->getClientOriginalExtension();
                $filename = now()->format('Ymd_His') . '_' . uniqid() . '.' . $extension;
                $file_cv->move('uploads/files/file_cv', $filename);
                $apply->file_cv = 'uploads/files/file_cv/'. $filename; 
            } else {
                $apply->file_cv = null; 
            }
            // file slip payment
            if ($request->hasFile('file_slip_payment')) {
                $file_slip_payment = $request->file('file_slip_payment');
                $extension = $file_slip_payment->getClientOriginalExtension();
                $filename = now()->format('Ymd_His') . '_' . uniqid() . '.' . $extension;
                $file_slip_payment->move('uploads/files/file_slip_payment', $filename);
                $apply->file_slip_payment = 'uploads/files/file_slip_payment/'. $filename; 
            } else {
                $apply->file_slip_payment = null; 
            }
            // file work
            if ($request->hasFile('file_work')) {
                $file_work = $request->file('file_work');
                $extension = $file_work->getClientOriginalExtension();
                $filename = now()->format('Ymd_His') . '_' . uniqid() . '.' . $extension;
                $file_work->move('uploads/files/file_work', $filename);
                $apply->file_work = 'uploads/files/file_work/'. $filename; 
            } else {
                $apply->file_work = null; 
            }
            // file military
            if ($request->hasFile('file_military')) {
                $file_military = $request->file('file_military');
                $extension = $file_military->getClientOriginalExtension();
                $filename = now()->format('Ymd_His') . '_' . uniqid() . '.' . $extension;
                $file_military->move('uploads/files/file_military', $filename);
                $apply->file_military = 'uploads/files/file_military/'. $filename; 
            } else {
                $apply->file_military = null;
            }
            // file change name
            if ($request->hasFile('file_change_name')) {
                $file_change_name = $request->file('file_change_name');
                $extension = $file_change_name->getClientOriginalExtension();
                $filename = now()->format('Ymd_His') . '_' . uniqid() . '.' . $extension;
                $file_change_name->move('uploads/files/file_change_name', $filename);
                $apply->file_change_name = 'uploads/files/file_change_name/'. $filename; 
            } else {
                $apply->file_change_name = null;
            }
            $apply->prefix = $request->input('prefix');
            $apply->name_thai = $request->input('name_thai');
            $apply->name_eng = $request->input('name_eng');
            $apply->birthdate = $request->input('birthdate');
            $apply->thai_id = $request->input('thai_id');
            $apply->nickname_thai = $request->input('nickname_thai');
            $apply->height = $request->input('height');
            $apply->weight = $request->input('weight');
            $apply->age = $request->input('age');
            $apply->nationality = $request->input('nationality');
            $apply->ethnicity = $request->input('ethnicity');
            $apply->birthplace = $request->input('birthplace');
            $apply->bloodtype = $request->input('bloodtype');
            $apply->militaryStatus = $request->input('militaryStatus');
            $apply->status = $request->input('status');
            $apply->hasChildren = $request->input('hasChildren');
            $apply->children_count = $request->input('children_count');
            $apply->dadname = $request->input('dadname');
            $apply->dadjob = $request->input('dadjob');
            $apply->dadalive = $request->input('dadalive');
            $apply->momname = $request->input('momname');
            $apply->momjob = $request->input('momjob');
            $apply->momalive = $request->input('momalive');
            $apply->spounsename = $request->input('spounsename');
            $apply->spounse_career = $request->input('spounse_career');
            $apply->address = $request->input('address');
            $apply->province = $request->input('province');
            $apply->district = $request->input('district');
            $apply->subdistrict = $request->input('subdistrict');
            $apply->postcode = $request->input('postcode');
            $apply->curr_address = $request->input('curr_address');

            if ($request->input('select_province') || $request->input('curr_province')) {
                $apply->curr_province = $request->input('select_province') ?? $request->input('curr_province');
            }else {
                $apply->curr_province = $request->input('province');
            }

            if ($request->input('select_district') || $request->input('curr_district')) { 
                $apply->curr_district = $request->input('select_district') ?? $request->input('curr_district');   
            }else {
                $apply->curr_district = $request->input('district');
            }
            
            if ($request->input('select_subdistrict') || $request->input('curr_subdistrict')) {
                $apply->curr_subdistrict = $request->input('select_subdistrict') ?? $request->input('curr_subdistrict');     
            }else {
                $apply->curr_subdistrict = $request->input('subdistrict');
            }
            
            $apply->curr_postcode = $request->input('curr_postcode') ?? $request->input('postcode');
            $apply->phone_mobile = $request->input('phone_mobile');
            $apply->email = $request->input('email');
            $apply->facebook = $request->input('facebook') ?? NULL;
            $apply->line_id = $request->input('line_id') ?? NULL;
            $apply->has_car_license = $request->input('has_car_license') ?? NULL;
            $apply->car_license_number = $request->input('car_license_number') ?? NULL;
            $apply->has_motor_license = $request->input('has_motor_license') ?? NULL;
            $apply->motor_license_number = $request->input('motor_license_number') ?? NULL;
            $apply->travel = $request->input('travel') ?? NULL;
            $apply->typing_speed = $request->input('typing_speed') ?? NULL;
            $apply->q1 = $request->input('q1');
            $apply->q2 = $request->input('q2');
            $apply->q3 = $request->input('q3');
            $apply->q4 = $request->input('q4');
            $apply->q5 = $request->input('q5');
            $apply->q6 = $request->input('q6');
            $apply->q7 = $request->input('q7');
            $apply->q8 = $request->input('q8');
            $apply->q9 = $request->input('q9');
            $apply->reference_name = $request->input('reference_name');
            $apply->reference_relation = $request->input('reference_relation');
            $apply->reference_phone = $request->input('reference_phone');
            $apply->application_source = $request->input('application_source') === 'other' 
                ? 'อื่นๆ ' . $request->input('application_source_other') 
                : $request->input('application_source');
            $apply->start_work = $request->input('start_work');
            $apply->privacy = $request->input('privacy') === '1' ? 1 : 0;
            $apply->save();
            $lastId = $apply->id;

            // Send email to user after saving application
            try {
                $userEmail = $request->input('email');
                $subject = 'Application Received';
                $userData = [
                    'name' => $request->input('name_thai'),
                    'position' => $request->input('position'),
                    'datetime' => $datetime,
                ];
                $userMessage = view('emails.application_received', $userData)->render();

                if (config('mail.driver') !== 'log') {
                    Mail::send([], [], function ($message) use ($userEmail, $subject, $userMessage) {
                        $message->from('noreply@vbeyond.co.th', 'HR Apply Job Team')
                        ->to($userEmail)
                        ->subject($subject)
                        ->setBody($userMessage, 'text/html');
                    });
                } else {
                    Log::info('Mail driver is set to log. User email is not sent.');
                }
            } catch (\Exception $e) {
                Log::error('User email sending failed: ' . $e->getMessage());
            }

            // Send email to admin after saving application
            try {
                $adminEmail = 'sakeerin.k@vbeyond.co.th';
                $adminSubject = 'New Application Submitted';
                $adminData = [
                    'name' => $request->input('name_thai'),
                    'email' => $request->input('email'),
                    'position' => $request->input('position'),
                    'datetime' => $datetime,
                ];
                $adminMessage = view('emails.application_admin', $adminData)->render();

                if (config('mail.driver') !== 'log') {
                    Mail::send([], [], function ($message) use ($adminEmail, $adminSubject, $adminMessage) {
                        $message->from('noreply@vbeyond.co.th', 'HR Apply Job Team')
                        ->to($adminEmail)
                        ->subject($adminSubject)
                        ->setBody($adminMessage, 'text/html');
                    });
                } else {
                    Log::info('Mail driver is set to log. Admin email is not sent.');
                }
            } catch (\Exception $e) {
                Log::error('Admin email sending failed: ' . $e->getMessage());
            }

            // Call the saveConsent function to handle PDPA logic
            // $this->saveConsent($request);

            $educations = json_decode($request->input('educations'), true);
            $isEmptyEdu = empty(array_filter($educations, function ($edu) {
                return array_filter($edu); // True if at least one value is not empty
            }));
            if (!$isEmptyEdu) {
                foreach ($educations as $education) {
                    // Access each field
                    $level = $education['level'];
                    $school = $education['school'];
                    $country = $education['country'];
                    $program = $education['program'];
                    $major = $education['major'];
                    $gpa = $education['gpa'];
                    $graduate_year = $education['graduate_year'];

                    // Insert into DB
                    DB::table('educations')->insert([
                        'pid' => $lastId,
                        'level' => $level,
                        'school' => $school,
                        'country' => $country,
                        'program' => $program,
                        'major' => $major,
                        'gpa' => $gpa,
                        'graduate_year' => $graduate_year,
                    ]);
                }
            }
            
            $programs = json_decode($request->input('programs'), true);
            $isEmptyPro = empty(array_filter($programs, function ($program) {
                return array_filter($program); // True if at least one value is not empty
            }));
            if (!$isEmptyPro) {
                foreach ($programs as $program) {
                    // Access each field
                    $name = $program['name'];
                    $level = $program['level'];

                    // Insert into DB
                    DB::table('skill_programs')->insert([
                        'pid' => $lastId,
                        'name' => $name,
                        'level' => $level,
                    ]);
                }
            }
            
            
            $langs = json_decode($request->input('langs'), true);
            // $isEmptyLang = empty(array_filter($langs, function ($lang) {
            //     return array_filter($lang); // True if at least one value is not empty
            // }));
            foreach ($langs as $index => $lang) {
                $name = $lang['name'];
                $level = !empty($lang['level']) ? $lang['level'] : 'พื้นฐาน';
                $fileKey = 'langs_file_' . $index;

                $path = null;
                if ($request->hasFile($fileKey)) {
                    $file = $request->file($fileKey);
                    $extension = $file->getClientOriginalExtension();
                    $filename = now()->format('Ymd_His') . '_' . uniqid() . '.' . $extension;
                    $file->move('uploads/certification', $filename);
                    $path = 'uploads/certification/'. $filename;
                }

                DB::table('skill_langs')->insert([
                    'pid' => $lastId,
                    'name' => $name,
                    'level' => $level,
                    'file' => $path
                ]);
            }

            $trainings = json_decode($request->input('trainings'), true);
            $isEmptyTain = empty(array_filter($trainings, function ($training) {
                return array_filter($training); // True if at least one value is not empty
            }));
            if (!$isEmptyTain) {
            foreach ($trainings as $training) {
                    // Access each field
                    $year = $training['year'];
                    $duration = $training['duration'];
                    $topic = $training['topic'];
                    $institution = $training['institution'];
                
                    // Insert into DB
                    DB::table('trainings')->insert([
                        'pid' => $lastId,
                        'year' => $year,
                        'duration' => $duration,
                        'topic' => $topic,
                        'institution' => $institution,
                    ]);
                }
            }
            

            $works = json_decode($request->input('works'), true);
            $isEmptyWork = empty(array_filter($works, function ($work) {
                return array_filter($work); // True if at least one value is not empty
            }));
            if (!$isEmptyWork) {
                foreach ($works as $work) {
                    // Access each field
                    $company = $work['company'];
                    $position = $work['position'];
                    $responsibility = $work['responsibility'];
                    $duration = $work['duration'];
                    $otherIncome = $work['otherIncome'];
                    $reason = $work['reason'];
                    $currentsalary = $work['currentsalary'];
                
                    // Insert into DB
                    DB::table('work_experience')->insert([
                        'pid' => $lastId,
                        'company' => $company,
                        'position' => $position,
                        'responsibility' => $responsibility,
                        'duration' => $duration,
                        'otherIncome' => $otherIncome,
                        'reason' => $reason,
                        'currentsalary' => $currentsalary,
                    ]);
                }
            }
            
            return redirect()->back()->with('success', 'Apply successfully!');
        } catch (\Throwable $e) {
            Log::error('Application error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    private function saveConsent(Request $request)
    {
        // Get the host and dynamically set the referrerName based on the form
        $host = $request->getSchemeAndHttpHost();
        $referrerName = "{$host}/apply-form";

        // Prepare the identify_data
        $identifyData = array_filter([
            'name' => 'ชื่อ-สกุล',
            'email' => 'อีเมล์',
            'phone' => 'เบอร์โทรศัพท์',
            'address' => 'ที่อยู่',
            'id_card' => 'รหัสบัตรประชาชน',
            'birthdate' => 'วันเดือนปีเกิด',
            'nationality' => 'สัญชาติ',
            'ethnicity' => 'เชื้อชาติ',
            'job_application_documents' => 'เอกสารสมัครงาน',
        ]);

        $nameParts = explode(' ', $request->name_thai, 2);
        $dataSubject_Name = $nameParts[0]; // First part of the name
        $dataSubject_Surname = isset($nameParts[1]) ? $nameParts[1] : ''; // Rest as surname

        // Prepare consent data for API request
        $consentData = [
            'formName' => 'แบบฟอร์มสมัครงาน',
            'dataSubject_Name' => $dataSubject_Name,
            'dataSubject_Surname' => $dataSubject_Surname,
            'email' => $request->email,
            'identify_data' => implode(',', $identifyData),
            'time_Period' => 3650,
            'purpose' => 'ยืนยันและยอมรับนโยบายความเป็นส่วนตัว',
            'ip' => $request->ip(),
            'referrerName' => $referrerName,
        ];

        // Call the Add Consent API
        $client = new \GuzzleHttp\Client();
        $apiUrl = env('T_REG_API_URL') . '/Consent';
        $apiKey = env('T_REG_API_KEY');

        try {
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => $consentData,
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Error calling Add Consent API: ' . $e->getMessage()];
        }
    }
}
