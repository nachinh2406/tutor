<?php

const ACTIVE = 1;
const INACTIVE = 0;
const ROLE_ADMIN = 1;

// cấp học
const LEVEL_HIGH_SCHOOL = 1;
const LEVEL_SECOND_SCHOOL = 2;
const LEVEL_PRIMARY_SCHOOL = 3;
const LEVEL_DIFFERENT_SCHOOL = 4;

// trạng thái giao lớp
const ASSIGN_PENDING = 1;
const ASSIGN_ACTED = 2;
const ASSIGN_CANCEL = 0;


const LEVEL_SCHOOL = [
    "1" => "Cấp THPT",
    "2" => "Cấp THCS",
    "3" => "Cấp Tiểu Học",
    "4" => "Các cấp khác",
];

const DAYS = [
    "2" => "Thứ 2",
    "3" => "Thứ 3",
    "4" => "Thứ 4",
    "5" => "Thứ 5",
    "6" => "Thứ 6",
    "7" => "Thứ 7",
    "8" => "Chủ nhật",
];

const GENDER_REQUEST = [
    "1" => "Sinh viên nam",
    "2" => "Sinh viên nữ",
    "3" => "Giáo viên nam",
    "4" => "Giáo viên nữ",
    "5" => "Không yêu cầu giới tính",
];

// const type district, province

const PROVINCE = 1;
const DISTRICT = 2;

const GENDER_MALE = 1;
const GENDER_FEMALE = 2;
const GENDER_DIFFERENT = 3;


const FOLDER_ADMIN = "admin";
const FOLDER_CLIENT = "client";

const ROOT_S3 = "https://tutorsproject.s3.ap-southeast-1.amazonaws.com/";
// const collage
const UNIVERSITIES_TOP = [
    1=> "Trường Đại học bách khoa hà nội",
    2=> "Trường Đại học kinh tế quốc dân",
    3=> "Trường Đại học công nghệ hà nội",
    4=> "Trường Đại học kinh tế - Đại học quốc gia Hà Nội",
    5=> "Trường Đại học bưu chính viễn thông",
    6=> "Trường Đại học khoa học xã hội nhân văn",
    7=> "Trường Đại học ngoại ngữ",
    8=> "Trường Đại học Hà Nội",
    9=> "Trường Đại học kĩ thuật mật mã",
    10=> "Trường Đại học y hà nội",
    11=> "Trường Đại học Sư phạm Hà Nội",
    12=> "Trường Học viện ngoại giao",
    13=> "Trường đại học ngoại thương",
];
const ROLE_USER = [
    1=>"Giáo viên",
    2=>"Sinh viên",
];
const DAY = [
    "Mon" => "Monday",
    "Tue" => "Tuesday",
    "Wed" => "Wednesday",
    "Thu" => "Thursday",
    "Fri" => "Friday",
    "Sat" => "Saturday",
    "Sun" => "Sunday"
];

































?>
