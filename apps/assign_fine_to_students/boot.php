<?php

$admin_student_fine_sub_menus = [
    [
        'name' => 'Assign Fine to Student',
        'link' => U.'assign_fine_to_students/app/add/'
    ]
];

add_menu_admin('Assign Fine to Student',U.'assign_fine_to_students/app','assign_fine_to_students','fal fa-file',2,$admin_student_fine_sub_menus);