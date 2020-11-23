<?php
$table = new Schema('zzz_13_fee_names');
$table->add('name', 'varchar', 256);
$table->add('code', 'int', 20);
$table->add('fee_group_id', 'int', 20);
$table->add('is_taxable', 'boolean', '', false);
$table->add('is_fine_applicable', 'boolean', '', false);
$table->add('is_discount_applicable', 'boolean', '', false);
$table->add('is_scholarship_applicable', 'boolean', '', false);
$table->add('is_active', 'boolean', '', false);
$table->add('created_at', 'TIMESTAMP', '', 'null');
$table->add('updated_at', 'TIMESTAMP', '', 'null');
$table->save();