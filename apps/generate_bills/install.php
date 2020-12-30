<?php
$table_billings = new Schema('zzz_22_billings');
$table_billings->add('fee', 'int', 20);
$table_billings->add('month', 'varchar', 256);
$table_billings->add('fine', 'int', 20);
$table_billings->add('discount', 'int', 20);
$table_billings->add('scholarship', 'int', 20);
$table_billings->add('total_fee', 'int', 20);
$table_billings->add('generated_by_id', 'int', 11);
$table_billings->add('billing_period_id', 'int', 11);
$table_billings->add('student_id', 'int', 11);
$table_billings->add('fiscal_year_id', 'int', 11);
$table_billings->add('print_no', 'int', 11);
$table_billings->add('created_at', 'TIMESTAMP', '', 'null');
$table_billings->add('updated_at', 'TIMESTAMP', '', 'null');
$table_billings->save();

$table_billing_logs = new Schema('zzz_23_billing_logs');
$table_billing_logs->add('billing_period_id', 'int', 11);
$table_billing_logs->add('billing_id', 'int', 11);
$table_billing_logs->add('student_id', 'int', 11);
$table_billing_logs->add('fiscal_year_id', 'int', 11);
$table_billing_logs->add('created_at', 'TIMESTAMP', '', 'null');
$table_billing_logs->add('updated_at', 'TIMESTAMP', '', 'null');
$table_billing_logs->save();

$table_billing_logs = new Schema('zzz_24_billing_fee');
$table_billing_logs->add('billing_id', 'int', 11);
$table_billing_logs->add('fee_id', 'int', 11);
$table_billing_logs->add('created_at', 'TIMESTAMP', '', 'null');
$table_billing_logs->add('updated_at', 'TIMESTAMP', '', 'null');
$table_billing_logs->save();

$table_billing_logs = new Schema('zzz_25_billing_fine');
$table_billing_logs->add('billing_id', 'int', 11);
$table_billing_logs->add('fine_id', 'int', 11);
$table_billing_logs->add('created_at', 'TIMESTAMP', '', 'null');
$table_billing_logs->add('updated_at', 'TIMESTAMP', '', 'null');
$table_billing_logs->save();

$table_billing_logs = new Schema('zzz_26_billing_discount');
$table_billing_logs->add('billing_id', 'int', 11);
$table_billing_logs->add('discount_id', 'int', 11);
$table_billing_logs->add('created_at', 'TIMESTAMP', '', 'null');
$table_billing_logs->add('updated_at', 'TIMESTAMP', '', 'null');
$table_billing_logs->save();

$table_billing_logs = new Schema('zzz_27_billing_scholarship');
$table_billing_logs->add('billing_id', 'int', 11);
$table_billing_logs->add('scholarship_id', 'int', 11);
$table_billing_logs->add('created_at', 'TIMESTAMP', '', 'null');
$table_billing_logs->add('updated_at', 'TIMESTAMP', '', 'null');
$table_billing_logs->save();

$table_billing_updates = new Schema('zzz_28_billing_updates');
$table_billing_updates->add('from_fee', 'int', 20);
$table_billing_updates->add('to_fee', 'int', 20);
$table_billing_updates->add('creator_id', 'int', 11);
$table_billing_updates->add('student_id', 'int', 11);
$table_billing_updates->add('billing_period_id', 'int', 11);
$table_billing_updates->add('fiscal_year_id', 'int', 11);
$table_billing_updates->add('created_at', 'TIMESTAMP', '', 'null');
$table_billing_updates->add('updated_at', 'TIMESTAMP', '', 'null');
$table_billing_updates->save();