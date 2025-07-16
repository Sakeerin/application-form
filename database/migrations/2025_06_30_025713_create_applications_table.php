<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->string('salary');
            $table->string('prefix');
            $table->string('name_thai');
            $table->string('name_eng');
            $table->date('birthdate');
            $table->string('thai_id', 13)->unique();
            $table->string('nickname_thai')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('age');
            $table->string('nationality');
            $table->string('ethnicity');
            $table->string('birthplace')->nullable();
            $table->string('militaryStatus')->nullable();
            $table->string('status')->nullable();
            $table->string('hasChildren')->nullable();
            $table->integer('children_count')->nullable();
            $table->string('dadname')->nullable();
            $table->string('dadjob')->nullable();
            $table->string('dadalive')->nullable();
            $table->string('momname')->nullable();
            $table->string('momjob')->nullable();
            $table->string('momalive')->nullable();
            $table->string('spounsename')->nullable();
            $table->string('spounse_career')->nullable();
            $table->string('address');
            $table->string('province');
            $table->string('district');
            $table->string('subdistrict');
            $table->integer('postcode');
            $table->string('curr_address');
            $table->string('curr_province');
            $table->string('curr_district');
            $table->string('curr_subdistrict');
            $table->integer('curr_postcode');
            $table->string('phone_mobile', 20);
            $table->string('email'); 
            $table->string('facebook')->nullable();
            $table->string('line_id')->nullable();
            $table->string('has_car_license')->nullable();
            $table->string('car_license_number')->nullable();
            $table->string('has_motor_license')->nullable();
            $table->string('motor_license_number')->nullable();
            $table->string('travel')->nullable();
            $table->string('q1')->comment('ท่านเคยเป็นหนี้อยู่ในระหว่างการติดสัญญากับสถาบันการเงินหรือไม่');
            $table->string('q2')->comment('รายชื่อสถาบันทางการเงินที่ท่านเคยใช้บริการหรือใช้บริการย้อน');
            $table->string('q3')->comment('ท่านเคยเล่นหรือเคยเกี่ยวข้องกับการพนันใด ๆ หรือไม่');
            $table->string('q4')->comment('ท่านเคยต้องโทษหรือต้องคดีอาญาหรือไม่');
            $table->string('q5')->comment('ท่านเคยเสพสิ่งเสพติดหรือของมึนเมาหรือไม่');
            $table->string('q6')->comment('ท่านไม่ใช่บุคคลตั้งครรภ์ใช่หรือไม่');
            $table->string('q7')->comment('ท่านเคยมีประวัติการรักษาหรือโรคประจำตัว หรือรักษาทางจิตหรือไม่');
            $table->string('q8')->comment('ท่านเคยขึ้นทะเบียนเป็นผู้ประกันตนกับสำนักงานประกันสังคมหรือไม่');
            $table->string('q9')->comment('ท่านยอมรับการทดลองงาน 119 วันหรือไม่');
            $table->string('q10')->comment('ท่านเคยเข้าร่วมกิจกรรมของคณะกรรมการลูกจ้าง/สหภาพแรงงานหรือไม่');
            $table->string('q11')->comment('ท่านมีภาระค่าใช้จ่ายในครอบครัวหรือไม่');
            $table->string('q12')->comment('ท่านเคยได้รับการรักษาโรคร้ายแรงหรือไม่');
            $table->string('q13')->comment('ในครอบครัวท่านเคยมีโรคติดต่อร้ายแรงหรือไม่');
            $table->string('reference_name'); 
            $table->string('reference_relation'); 
            $table->string('phone_2', 20);
            $table->string('application_source')->nullable();
            $table->date('detail_2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
