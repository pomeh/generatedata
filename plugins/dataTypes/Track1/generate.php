<?php

// this lets the processor know that this data type relies on data defined in other fields. That
// information is either hardcoded in the functions below, or passed via an option
$track1_process_order = 1;

//Visa
$visaPrefixList[] =  "4539";
$visaPrefixList[] =  "4556";
$visaPrefixList[] =  "4916";
$visaPrefixList[] =  "4532";
$visaPrefixList[] =  "4929";
$visaPrefixList[] =  "40240071";
$visaPrefixList[] =  "4485";
$visaPrefixList[] =  "4716";
$visaPrefixList[] =  "4";

//Visa Electron
$visaelectronPrefixList[] =  "4026";
$visaelectronPrefixList[] =  "417500";
$visaelectronPrefixList[] =  "4508";
$visaelectronPrefixList[] =  "4844";
$visaelectronPrefixList[] =  "4913";
$visaelectronPrefixList[] =  "4917";

//Mastercard
$mastercardPrefixList[] =  "51";
$mastercardPrefixList[] =  "52";
$mastercardPrefixList[] =  "53";
$mastercardPrefixList[] =  "54";
$mastercardPrefixList[] =  "55";

//American Express
$americanexpressPrefixList[] = "34";
$americanexpressPrefixList[] = "37";

//Discover
$discoverPrefixList[] = "6011";
$discoverPrefixList[] = "644";
$discoverPrefixList[] = "645";
$discoverPrefixList[] = "646";
$discoverPrefixList[] = "647";
$discoverPrefixList[] = "648";
$discoverPrefixList[] = "649";
$discoverPrefixList[] = "65";
for($dpl=622126; $dpl <= 622925; $dpl++){
	$discoverPrefixList[] = $dpl;
}

//American Diner's-------------------------
//$dinersclubADPrefixList[] = "30"; 

//Carte Blanche
$dinersclubCBPrefixList[] = "300"; 
$dinersclubCBPrefixList[] = "301";
$dinersclubCBPrefixList[] = "302";
$dinersclubCBPrefixList[] = "303";
$dinersclubCBPrefixList[] = "304";
$dinersclubCBPrefixList[] = "305";

//Diner's Club International
$dinersclubIPrefixList[] = "36"; 

//enRoute
$dinersclubERPrefixList[] = "2014"; 
$dinersclubERPrefixList[] = "2149";

//JCB
for($jpl=3528; $jpl <= 3589; $jpl++){
	$jcb16PrefixList[] = $jpl;
}
$jcb16PrefixList[] = "31";
$jcb16PrefixList[] = "309";

$jcb15PrefixList[] = "2131";
$jcb15PrefixList[] = "1800";

//Maestro
$maestroPrefixList[] = "5018";
$maestroPrefixList[] = "5020";
$maestroPrefixList[] = "5038";
$maestroPrefixList[] = "6304";
$maestroPrefixList[] = "6759";
$maestroPrefixList[] = "6761";
$maestroPrefixList[] = "6762";
$maestroPrefixList[] = "6763";
$maestroPrefixList[] = "5893";
$maestroPrefixList[] = "58";
$maestroPrefixList[] = "56";
$maestroPrefixList[] = "57";

//Solo
$soloPrefixList[] = "6334";
$soloPrefixList[] = "6767";

//Switch
$switchPrefixList[] = "4903";
$switchPrefixList[] = "4905";
$switchPrefixList[] = "4911";
$switchPrefixList[] = "4936";
$switchPrefixList[] = "564182";
$switchPrefixList[] = "633110";
$switchPrefixList[] = "6333";
$switchPrefixList[] = "6759";

//Laser
$laserPrefixList[] = "6304";
$laserPrefixList[] = "6706";
$laserPrefixList[] = "6771";
$laserPrefixList[] = "6709";

/**
 * --- Required function! ---
 *
 * For this data type, row # and metadata aren't needed.
 *
 * @param integer $row the row number in the generated content
 * @param mixed $options whatever options were passed for this function (string in this case)
 * @param array $metadata
 * @return string
 */

function track1_generate_item($row, $str, $existing_row_data){
	
	
	$track1 = track1_generate_track_number();
				
  return $track1;
}


/**
 * --- Required function! ---
 *
 * For this data type, row # and metadata aren't needed.
 *
 * @param string $export_type e.g. "sql"
 * @param mixed $options e.g. "mysql" or "oracle"
 * @return string
 */
function track1_get_export_type_info($export_type, $options)
{
  $info = "";
  switch ($export_type)
  {
  	case "sql":
  		if ($options == "MySQL" || $options == "SQLite")
        $info = "varchar(255) default NULL";
      else if ($options == "Oracle")
        $info = "varchar2(255) default NULL";
  	  break;
  }

  return $info;
}

// ------------------------------------------------------------------------------------------------

//---------to create 26 random numbers-------------------
 function track1_rand_str($length = 26, $chars = '1234567890')
								{
   
								 $chars_length = (strlen($chars) - 1);
								 $string = $chars{rand(0, $chars_length)};
    
									 for ($ii = 1; $ii < $length; $ii = strlen($string))
										{
											$r = $chars{rand(0, $chars_length)};
											if ($r != $string{$ii - 1}) $string .=  $r;
										}
											return $string;
								}

								
 function track1_completed_number($prefix, $length) {

    $ccnumber = $prefix;

    # generate digits

    while ( strlen($ccnumber) < ($length - 1) ) {
        $ccnumber .= rand(0,9);
    }

    # Calculate sum

    $sum = 0;
    $pos = 0;

    $reversedCCnumber = strrev( $ccnumber );

    while ( $pos < $length - 1 ) {

        $odd = $reversedCCnumber[ $pos ] * 2;
        if ( $odd > 9 ) {
            $odd -= 9;
        }

        $sum += $odd;

        if ( $pos != ($length - 2) ) {

            $sum += $reversedCCnumber[ $pos +1 ];
        }
        $pos += 2;
    }

    # Calculate check digit

    $checkdigit = (( floor($sum/10) + 1) * 10 - $sum) % 10;
    $ccnumber .= $checkdigit;

    return $ccnumber;
}

 function track1_credit_card_number($prefixList, $length, $howMany) {

    for ($i = 0; $i < $howMany; $i++) {

        $ccnumber = $prefixList[ array_rand($prefixList) ];
        $result[] = pan_completed_number($ccnumber, $length);
    }

    return $result;
}

 function track1_generate_track_number(){
 
	global $mastercardPrefixList, $visaPrefixList, $visaelectronPrefixList, $americanexpressPrefixList, $discoverPrefixList, $dinersclubADPrefixList, $dinersclubCBPrefixList, $dinersclubIPrefixList, $dinersclubERPrefixList, $dinersclubERPrefixList, $jcb16PrefixList, $jcb15PrefixList, $maestroPrefixList, $soloPrefixList, $switchPrefixList, $laserPrefixList;
	
	//Masteracard
	$mastercard = track1_credit_card_number($mastercardPrefixList, 16, 1);
	//Visa Electron
	$visaelectron = track1_credit_card_number($visaPrefixList, 16, 1);
	//Visa
	$visa13 = track1_credit_card_number($visaPrefixList, 13, 1);
	$visa16 = track1_credit_card_number($visaPrefixList, 16, 1);
	//Amex
	$americanexpress = track1_credit_card_number($americanexpressPrefixList, 15, 1);
	//Discover
	$discover = track1_credit_card_number($discoverPrefixList, 16, 1);
	//Carte Blanche
	$dinersclubCB = track1_credit_card_number($dinersclubCBPrefixList, 14, 1);
	//Diners Club International
	$dinersclubI = track1_credit_card_number($dinersclubIPrefixList, 14, 1);
	//Enroute
	$dinersclubER = track1_credit_card_number($dinersclubERPrefixList, 15, 1);
	//JCB
	$jcb16 = track1_credit_card_number($jcb16PrefixList, 16, 1);
	$jcb15 = track1_credit_card_number($jcb15PrefixList, 15, 1);
	//Maestro
	$maestro12 = track1_credit_card_number($maestroPrefixList, 12, 1);
	$maestro13 = track1_credit_card_number($maestroPrefixList, 13, 1);
	$maestro14 = track1_credit_card_number($maestroPrefixList, 14, 1);
	$maestro15 = track1_credit_card_number($maestroPrefixList, 15, 1);
	$maestro16 = track1_credit_card_number($maestroPrefixList, 16, 1);
	$maestro17 = track1_credit_card_number($maestroPrefixList, 17, 1);
	$maestro18 = track1_credit_card_number($maestroPrefixList, 18, 1);
	$maestro19 = track1_credit_card_number($maestroPrefixList, 19, 1);
	//Solo
	$solo16 = track1_credit_card_number($soloPrefixList, 16, 1);
	$solo18 = track1_credit_card_number($soloPrefixList, 18, 1);
	$solo19 = track1_credit_card_number($soloPrefixList, 19, 1);
	//Switch
	$switch16 = track1_credit_card_number($switchPrefixList, 16, 1);
	$switch18 = track1_credit_card_number($switchPrefixList, 18, 1);
	$switch19 = track1_credit_card_number($switchPrefixList, 19, 1);
	//Laser
	$laser16 = track1_credit_card_number($laserPrefixList, 16, 1);
	$laser17 = track1_credit_card_number($laserPrefixList, 17, 1);
	$laser18 = track1_credit_card_number($laserPrefixList, 18, 1);
	$laser19 = track1_credit_card_number($laserPrefixList, 19, 1);
	
	$characters = array("A","B","C","D","E","F","G","H","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y","Z");
		$keys = array();

		while(count($keys) < 4) 
        {
		 $x = mt_rand(0, count($characters)-1);
		 if(!in_array($x, $keys)) 
		 {
			$keys[] = $x;
		 }
		}
		$random_chars = "";
		foreach($keys as $key)
		{
			//array_push($random_chars, $characters[$key]);
			$random_chars = $random_chars.$characters[$key];
		}
	
		$random_dt = mt_rand();
		$calender = date("ym",$random_dt);
				
		$service_code=rand(111,999);
				
		$num1 = track1_rand_str();
		$num2 = track1_rand_str();
		
		$rand_ccnum = array($mastercard[0],$visaelectron[0],$visa13[0],$visa16[0],$americanexpress[0],$discover[0],$dinersclubCB[0],$dinersclubI[0],$dinersclubER[0],$jcb16[0],$jcb15[0],$maestro12[0],$maestro13[0],$maestro14[0],$maestro15[0],$maestro16[0],$maestro17[0],$maestro18[0],$maestro19[0],$solo16[0],$solo18[0],$solo19[0],$switch16[0],$switch18[0],$switch19[0],$laser16[0],$laser17[0],$laser18[0],$laser19[0]); 
		
		$get_rand_ccnum = array_rand($rand_ccnum);
		
		
		$track1 = "%B$rand_ccnum[$get_rand_ccnum]^CardUser/$random_chars^$calender$service_code$num1?";
		$random_chars =NULL;
		return $track1;
 
 }