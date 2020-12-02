<?php

$admin_student_discount_sub_menus = [
    [
        'name' => 'Assign Discount to Student',
        'link' => U.'assign_discount_to_students/app/add/'
    ]
];

add_menu_admin('Assign Discount to Student',U.'assign_discount_to_students/app','assign_discount_to_students','fal fa-file',2,$admin_student_discount_sub_menus);