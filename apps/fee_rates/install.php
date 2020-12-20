<?php
$table = new Schema('zzz_14_fee_rates');
$table->add('fiscal_year_id', 'int', 10);
$table->add('class_id', 'int', 10);
$table->add('category_id', 'int', 10);
$table->add('sub_category_id', 'int', 10);
$table->add('faculty_id', 'int', 10);
$table->add('student_type_id', 'int', 10);
$table->add('created_at', 'TIMESTAMP', '', 'null');
$table->add('updated_at', 'TIMESTAMP', '', 'null');
$table->save();

$table_fee_structures = new Schema('zzz_15_fee_structures');
$table_fee_structures->add('fee_rate_id', 'int', 10);
$table_fee_structures->add('fee_names_id', 'int', 10);
$table_fee_structures->add('amount', 'varchar', 255);
$table_fee_structures->add('created_at', 'TIMESTAMP', '', 'null');
$table_fee_structures->add('updated_at', 'TIMESTAMP', '', 'null');
$table_fee_structures->save();