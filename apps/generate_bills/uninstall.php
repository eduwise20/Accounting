<?php
$table_billings = new Schema('zzz_22_billings');
$table_billings->drop();

$table_billing_logs = new Schema('zzz_23_billing_logs');
$table_billing_logs->drop();

$table_billing_fees = new Schema('zzz_24_billing_fee');
$table_billing_fees->drop();

$table_billing_fines = new Schema('zzz_25_billing_fine');
$table_billing_fines->drop();

$table_billing_discounts = new Schema('zzz_26_billing_discount');
$table_billing_discounts->drop();

$table_billing_scholarships = new Schema('zzz_27_billing_scholarship');
$table_billing_scholarships->drop();

$table_billing_updates = new Schema('zzz_28_billing_updates');
$table_billing_updates->drop();