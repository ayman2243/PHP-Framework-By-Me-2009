<?php

function validate_image($ImagePatch)
{
	error_reporting(0);
	
	$size = getimagesize($ImagePatch);
    $fp = fopen($ImagePatch, "rb");
    if ($size && $fp) { return true; } else { return false; }
	
    error_reporting(E_ALL);
    
}











?>