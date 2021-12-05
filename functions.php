<?php
function get_safe_value($con, $str)
{
    if ($str != '') {
        return htmlspecialchars(mysqli_real_escape_string($con, $str));
    }
    return $str;
}
