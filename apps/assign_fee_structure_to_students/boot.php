<?php

$admin_student_fee_name_sub_menus = [
    [
        'name' => 'Assign Fee to Student',
        'link' => U.'assign_fee_structure_to_students/app/add/'
    ]
];

add_menu_admin('Assign Fee to Student',U.'assign_fee_structure_to_students/app','assign_fee_structure_to_students','fal fa-file',2,$admin_student_fee_name_sub_menus);