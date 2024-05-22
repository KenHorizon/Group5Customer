<?php
function function_alert($message)
{
    echo "<script>alert('$message');</script>";
}
function split($string, $limit)
{
    return explode($limit, $string);
}
function formatDate($date, $format = null, $showYear = true)
{   
    if ($date == 0) return "N/A";
    $getYear = split($date, "-")[0];
    $getMonth = split($date, "-")[1];
    $split_time_stamp  = split($date, "-")[2];
    $getDay = (int) split($split_time_stamp, " ")[0];
    if ($format === true) {
        $getMonth = convertMonthToNames($getMonth);
        if ($showYear == true) {
            return "{$getMonth} {$getDay}, {$getYear}";
        } else {
            return "{$getMonth} {$getDay}";
        }
    } else {
        if ($showYear == true) {
            return "{$getMonth} {$getDay}, {$getYear}";
        } else {
            return "{$getMonth} {$getDay}";
        }
    }
    // $joined_year = split($user->account()["created_at"], "-")[0];
    // $joined_month = convertMonthToNames(split($user->account()["created_at"], "-")[1]);
    // $joined_removeTimeStamp = split($user->account()["created_at"], "-")[2];
    // $joined_day = (int) split($joined_removeTimeStamp, " ")[0];
    // $joined = "{$joined_month} {$joined_day}, {$joined_year}";
}
function configuration($data) {
    return $data == 1 ? true : false;
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
function checkSubscriptionStatus($number)
{
    if ($number == 1) {
        return "Activated";
    } else {
        return "Deactivated";
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
function checkIfEmpty($check)
{
    return empty($check) ? "-" : $check;
}
function settings($check, $database = null)
{   
    if ($check == 0) {
        return 1;
    } else {
        return 0;
    }
}
function hasSubscription()
{
    return $_SESSION["subscriptionStart"] > 0;
}

function setTime(int $year = null, int $month = null, int $week = null, int $day = null, int $hour = null, int $minute = null, int $second = null)
{

    return ($second) + (60 * $minute) + (3600 * $hour) + (86400 * $day) + (604800 * $week) + (2.628e+6 * $month) + (3.154e+7 * $year);
}
