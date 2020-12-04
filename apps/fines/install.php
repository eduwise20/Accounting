<?php
$table = new Schema('zzz_10_fines');
$table->add('name', 'varchar', 256);
$table->add('type', 'varchar', 256);
$table->add('fiscal_year_id', 'int', 20);
$table->add('amount', 'bigint', 20);
$table->add('is_active', 'boolean', '', false);
$table->add('remarks', 'varchar', 256);
$table->add('created_at', 'TIMESTAMP', '', 'null');
$table->add('updated_at', 'TIMESTAMP', '', 'null');
$table->save();

$table_fine_student = new Schema('fine_student');
$table_fine_student->add('student_id', 'int', 20);
$table_fine_student->add('fine_id', 'int', 20);
$table_fine_student->add('billing_period_id', 'int', 20);
$table_fine_student->add('billing_date', 'varchar', 256);
$table_fine_student->add('created_at', 'TIMESTAMP', '', 'null');
$table_fine_student->add('updated_at', 'TIMESTAMP', '', 'null');
$table_fine_student->save();