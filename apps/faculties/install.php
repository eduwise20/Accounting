<?php
$table = new Schema('zzz_3_faculties');
$table->add('name', 'varchar', 256);
$table->add('code', 'int', 20);
$table->add('class_id', 'int', 20);
$table->add('created_at', 'TIMESTAMP', '', 'null');
$table->add('updated_at', 'TIMESTAMP', '', 'null');
$table->save();