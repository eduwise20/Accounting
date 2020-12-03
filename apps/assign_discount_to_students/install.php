<?php
$table = new Schema('fee_structure_student_discount');
$table->add('student_id', 'int', 20);
$table->add('fee_name_id', 'int', 20);
$table->add('discount_id', 'int', 20);
$table->add('billing_period_id', 'int', 20);
$table->add('yearly_applicable', 'boolean', '', false);
$table->add('created_at', 'TIMESTAMP', '', 'null');
$table->add('updated_at', 'TIMESTAMP', '', 'null');
$table->save();