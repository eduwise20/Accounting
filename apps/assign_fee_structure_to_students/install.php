<?php
$table = new Schema('fee_name_student');
$table->add('student_id', 'int', 20);
$table->add('fee_name_id', 'int', 20);
$table->add('created_at', 'TIMESTAMP', '', 'null');
$table->add('updated_at', 'TIMESTAMP', '', 'null');
$table->save();