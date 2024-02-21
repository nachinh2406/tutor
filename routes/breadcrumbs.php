<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Trang chủ', route('admin.dashboard'));
});
// class
Breadcrumbs::for('classes.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Danh sách khối học', route('admin.classes.index'));
});

Breadcrumbs::for('classes.create', function ($trail) {
    $trail->parent('classes.index');
    $trail->push('Thêm mới khối học', route('admin.classes.create'));
});

Breadcrumbs::for('classes.show', function ($trail, $class) {
    $trail->parent('classes.index');
    $trail->push($class->name_class);
});
// end class

// contract
Breadcrumbs::for('contracts.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Danh sách hợp đồng', route('admin.contracts.index'));
});

Breadcrumbs::for('contracts.create', function ($trail) {
    $trail->parent('contracts.index');
    $trail->push('Thêm mới hợp đồng', route('admin.contracts.create'));
});

Breadcrumbs::for('contracts.show', function ($trail, $contract) {
    $trail->parent('contracts.index');
    $trail->push($contract->title);
});

// subject category
Breadcrumbs::for('subject-categories.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Danh sách môn học', route('admin.subject-categories.index'));
});

Breadcrumbs::for('subject-categories.create', function ($trail) {
    $trail->parent('subject-categories.index');
    $trail->push('Thêm mới môn học', route('admin.subject-categories.create'));
});

Breadcrumbs::for('subject-categories.show', function ($trail, $subjectCategory) {
    $trail->parent('subject-categories.index');
    $trail->push($subjectCategory->name);
});
// end subject category

// subject
Breadcrumbs::for('subjects.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Danh sách môn học', route('admin.subjects.index'));
});
Breadcrumbs::for('subjects.create', function ($trail) {
    $trail->parent('subjects.index');
    $trail->push('Thêm mới môn học', route('admin.subjects.create'));
});
Breadcrumbs::for('subjects.show', function ($trail, $subjectCategory) {
    $trail->parent('subjects.index');
    $trail->push($subjectCategory->name);
});
// end subject
// class register
Breadcrumbs::for('classes-register.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Danh sách lớp đăng ký', route('admin.classes-register.index'));
});
Breadcrumbs::for('classes-register.create', function ($trail) {
    $trail->parent('classes-register.index');
    $trail->push('Đăng ký lớp mới', route('admin.classes-register.create'));
});
Breadcrumbs::for('classes-register.show', function ($trail, $subjectCategory) {
    $trail->parent('classes-register.index');
    $trail->push($subjectCategory->code_class);
});
// end class register
// list tutorior
Breadcrumbs::for('users.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Danh sách gia sư', route('admin.users.index'));
});
// list tutorior
// list tutorior
Breadcrumbs::for('roles.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Danh sách quyền hạn', route('admin.roles.index'));
});
// list tutorior
// list tutorior
Breadcrumbs::for('admins.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Danh sách admins', route('admin.admins.index'));
});
// list tutorior
