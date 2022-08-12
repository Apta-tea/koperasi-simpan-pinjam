<?php
function tgl_id($d)
{
    //2022-07-24
    return substr($d,8,2).'-'.substr($d,5,2).'-'.substr($d,0,4);
}
?>