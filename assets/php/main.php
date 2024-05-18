<?php
function function_alert($message)
{
    echo "<script>alert('$message');</script>";
}
function split($string, $limit)
{
    return explode($limit, $string);
}
function formatDate($birthday, $format = null)
{
    $getYear = split($birthday, "-")[0];
    $getMonth = split($birthday, "-")[1];
    $split_time_stamp  = split($birthday, "-")[2];
    $getDay = (int) split($split_time_stamp, " ")[0];
    if ($format === true) {
        $getMonth = convertMonthToNames($getMonth);
        return "{$getMonth} {$getDay}, {$getYear}";
    } else {
        return "{$getMonth} {$getDay}, {$getYear}";
    }
    // $joined_year = split($user->account()["created_at"], "-")[0];
    // $joined_month = convertMonthToNames(split($user->account()["created_at"], "-")[1]);
    // $joined_removeTimeStamp = split($user->account()["created_at"], "-")[2];
    // $joined_day = (int) split($joined_removeTimeStamp, " ")[0];
    // $joined = "{$joined_month} {$joined_day}, {$joined_year}";
}
function convertMonthToNames($number)
{
    switch ($number) {
        case 1:
            return $output = "January";
            break;
        case 2:
            return $output = "February";
            break;
        case 3:
            return $output = "March";
            break;
        case 4:
            return $output = "April";
            break;
        case 5:
            return $output = "May";
            break;
        case 6:
            return $output = "June";
            break;
        case 7:
            return $output = "July";
            break;
        case 8:
            return $output = "August";
            break;
        case 9:
            return $output = "September";
            break;
        case 10:
            return $output = "October";
            break;
        case 11:
            return $output = "November";
            break;
        case 12:
            return $output = "December";
            break;
        default:
            return $output = "Invalid!";
    }
}
function convertZeroNumber($number)
{
    if ($number > 10) {
        return $number;
    } else {
        return split($number, 0);
    }
}
function determineUserType($number)
{
    switch ($number) {
        case 0:
            return $output = "User";
            break;
        case 1:
            return $output = "Admin";
            break;
        default:
            return $output = "User!";
    }
}
function getVerificationCode($length)
{
    $characters = '0123456789';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}
function hasSubscription()
{
    return $_SESSION["subscriptionStart"] > 0;
}

function setTime(int $year = null, int $month = null, int $week = null, int $day = null, int $hour = null, int $minute = null, int $second = null)
{

    return ($second) + (60 * $minute) + (3600 * $hour) + (86400 * $day) + (604800 * $week) + (2.628e+6 * $month) + (3.154e+7 * $year);
}
