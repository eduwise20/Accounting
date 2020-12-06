<?php
$table = new Schema('zzz_12_discounts');
$table->add('name', 'varchar', 256);
$table->add('type', 'varchar', 256);
$table->add('fiscal_year_id', 'int', 20);
$table->add('amount', 'bigint', 20);
$table->add('is_recurring', 'boolean', '', false);
$table->add('is_active', 'boolean', '', false);
$table->add('remarks', 'varchar', 256);
$table->add('created_at', 'TIMESTAMP', '', 'null');
$table->add('updated_at', 'TIMESTAMP', '', 'null');
$table->save();


$table_student_discount = new Schema('zzz_20_fee_structure_student_discount');
$table_student_discount->add('student_id', 'int', 20);
$table_student_discount->add('fee_name_id', 'int', 20);
$table_student_discount->add('discount_id', 'int', 20);
$table_student_discount->add('billing_period_id', 'int', 20);
$table_student_discount->add('yearly_applicable', 'boolean', '', false);
$table_student_discount->add('created_at', 'TIMESTAMP', '', 'null');
$table_student_discount->add('updated_at', 'TIMESTAMP', '', 'null');
$table_student_discount->save();