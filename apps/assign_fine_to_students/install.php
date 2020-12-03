<?php
$table = new Schema('fine_student');
$table->add('student_id', 'int', 20);
$table->add('fine_id', 'int', 20);
$table->add('billing_period_id', 'int', 20);
$table->add('billing_date', 'varchar', 256);
$table->add('created_at', 'TIMESTAMP', '', 'null');
$table->add('updated_at', 'TIMESTAMP', '', 'null');
$table->save();