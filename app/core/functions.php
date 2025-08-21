<?php
function get_var($key, $default = "")
{
    if (isset($_POST[$key])) {
        return isset($_POST[$key]) ? $_POST[$key] : "";
    }
    return $default;
}

function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

function export_data_to_excel($fields = array(), $excelData = array(), $DataFileName = '')
{
    $fileName = $DataFileName . "_" . date('Y-m-d') . ".xls";

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$fileName\"");

    echo $excelData;
    exit();
}

function get_select($key, $value, $default = "")
{
    if (!empty($default)) {
        $_POST[$key] = $default;
    }
    if (isset($_POST[$key])) {
        if ($_POST[$key] == $value) {
            return "selected";
        }
    }
    return "";
}

function esc($var)
{
    return htmlspecialchars($var);
}

function random_string($length)
{
    $array = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
    $text = "";
    for ($x = 0; $x < $length; $x++) {
        $random = rand(0, 61);
        $text .= $array[$random];
    }
    return $text;
}

function cropAndResizeToJPG($sourcePath, $destination, $finalSize = 400, $quality = 80)
{
    // Detect image type
    if (!file_exists($sourcePath)) return false;

    // Read file content and create image resource
    $imgData = file_get_contents($sourcePath);
    if (!$imgData) return false;

    $src = @imagecreatefromstring($imgData);
    if (!$src) return false;

    // Get dimensions
    $width = imagesx($src);
    $height = imagesy($src);

    // Crop to square (center)
    $size = min($width, $height);
    $x = ($width - $size) / 2;
    $y = ($height - $size) / 2;

    // Create square canvas
    $square = imagecreatetruecolor($finalSize, $finalSize);

    // Fill background white (for PNG/GIF transparency)
    $white = imagecolorallocate($square, 255, 255, 255);
    imagefill($square, 0, 0, $white);

    // Resample (crop + resize)
    imagecopyresampled($square, $src, 0, 0, $x, $y, $finalSize, $finalSize, $size, $size);

    // Save as JPG
    $saved = imagejpeg($square, $destination, $quality);

    // Free memory
    imagedestroy($src);
    imagedestroy($square);

    return $saved ? $destination : false;
}

function generateRandomCode($length = 70)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

//this print and show all data
function show($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

//this get the correct date 
function get_date($date)
{
    return date("jS F, Y", strtotime($date));
}

//Select correct customer type
function get_Cust_type($typeName)
{
    $cuslist = array(
        'school' => "School",
        'booksh' => "Bookshop",
        'garris' => "Garrison",
        'agent' => "Agent",
    );
    return $cuslist[$typeName];
}

function short_text($text, $length = 100)
{
    if (strlen($text) > $length) {
        return substr($text, 0, $length) . '...';
    }
    return $text;
}

function get_status($status)
{
    $statusList = array(
        0 => "Active",
        1 => "In-Active",
    );
    return isset($statusList[$status]) ? $statusList[$status] : "Unknown";
}
