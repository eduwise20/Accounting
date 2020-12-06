<?php
$table = new Schema('zzz_11_scholarships');
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

$table_fee_structure_student_scholarship = new Schema('zzz_21_fee_structure_student_scholarship');
$table_fee_structure_student_scholarship->add('student_id', 'int', 20);
$table_fee_structure_student_scholarship->add('fee_name_id', 'int', 20);
$table_fee_structure_student_scholarship->add('scholarship_id', 'int', 20);
$table_fee_structure_student_scholarship->add('billing_period_id', 'int', 20);
$table_fee_structure_student_scholarship->add('yearly_applicable', 'boolean', '', false);
$table_fee_structure_student_scholarship->add('created_at', 'TIMESTAMP', '', 'null');
$table_fee_structure_student_scholarship->add('updated_at', 'TIMESTAMP', '', 'null');
$table_fee_structure_student_scholarship->save();