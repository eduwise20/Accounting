<?php
$table = new Schema('students');
$table->add('name', 'varchar', 256);
$table->add('class_id', 'int', 20);
$table->add('section_id', 'int', 20);
$table->add('admission_no', 'varchar', 256);
$table->add('roll_no', 'varchar', 256);
$table->add('category_id', 'int', 20);
$table->add('sub_category_id', 'int', 20);
$table->add('student_type_id', 'int', 20);
$table->add('faculty_id', 'int', 20);
$table->add('status', 'varchar', 256);
$table->add('remarks', 'varchar', 256);
$table->add('created_at', 'TIMESTAMP', '', 'null');
$table->add('updated_at', 'TIMESTAMP', '', 'null');
$table->save();

$table_student_additional_information = new Schema('student_additional_informations');
$table_student_additional_information->add('student_id', 'int', 20);
$table_student_additional_information->add('phone', 'varchar', 256);
$table_student_additional_information->add('current_address', 'varchar', 256);
$table_student_additional_information->add('permanent_address', 'varchar', 256);
$table_student_additional_information->add('parent_name', 'varchar', 256);
$table_student_additional_information->add('local_guardian_name', 'varchar', 256);
$table_student_additional_information->add('gender', 'varchar', 256);
$table_student_additional_information->add('created_at', 'TIMESTAMP', '', 'null');
$table_student_additional_information->add('updated_at', 'TIMESTAMP', '', 'null');
$table_student_additional_information->save();

$table_fee_name_student = new Schema('fee_name_student');
$table_fee_name_student->add('student_id', 'int', 20);
$table_fee_name_student->add('fee_name_id', 'int', 20);
$table_fee_name_student->add('created_at', 'TIMESTAMP', '', 'null');
$table_fee_name_student->add('updated_at', 'TIMESTAMP', '', 'null');
$table_fee_name_student->save();