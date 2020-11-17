<?php
$table = new Schema('zzz_4_student_types');
$table->add('name', 'varchar', 256);
$table->add('remarks', 'varchar', 256);
$table->add('created_at', 'TIMESTAMP', '', 'null');
$table->add('updated_at', 'TIMESTAMP', '', 'null');
$table->save();