<?php
$table = new Schema('students');
$table_student_additional_information = new Schema('student_additional_informations');
$table->drop();
$table_student_additional_information->drop();
$table_fee_name_student = new Schema('fee_name_student');
$table_fee_name_student->drop();