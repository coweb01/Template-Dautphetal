<?php

$n = 0;
foreach ($values as $value)
{
	// Skip empty value, adding an empty placeholder if field inside in field group
	if ( !strlen($value) )
	{
		if ( $is_ingroup )
		{
			$field->{$prop}[$n++]	= '';
		}
		continue;
	}


	 // characters to remove
	$remove = array('-', '/', ' ');
	 
	// remove to ugly chars
	$tel = str_replace($remove, " ", $value); 

	$tel = preg_replace("/\s+/", "", $tel);  // alle Leerzeichen entfernen 
	// ersten 3 stellen +49 
	$laenderkuerzel = substr($tel, 0, 3);
	if ($laenderkuerzel != '+49') {

			$tel = ( $tel[0] == 0 ) ? '+49' . substr($tel, 1) : '+49' . $tel;
	} 
	
	
	$value = '<a href="tel:'. $tel .'">' . $value . '</a>';

	
	// Add prefix / suffix
	$field->{$prop}[$n]	= $pretext . $value . $posttext;

	// Add microdata to every value if field -- is -- in a field group
	if ($is_ingroup && $itemprop) $field->{$prop}[$n] = '<div style="display:inline" itemprop="'.$itemprop.'" >' .$field->{$prop}[$n]. '</div>';

	$n++;
	if (!$multiple) break;  // multiple values disabled, break out of the loop, not adding further values even if the exist
}