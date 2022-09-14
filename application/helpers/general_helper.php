<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('thaiDate')){

  function thaiDate($dateTime){
      $day = array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
      $month = array(
       "0"=>"",
       "1"=>"ม.ค.",
       "2"=>"ก.พ.",
       "3"=>"มี.ค.",
       "4"=>"เม.ย.",
       "5"=>"พ.ค.",
       "6"=>"มิ.ย.",
       "7"=>"ก.ค.",
       "8"=>"ส.ค.",
       "9"=>"ก.ย.",
       "10"=>"ต.ค.",
       "11"=>"พ.ย.",
       "12"=>"ธ.ค."
     );
     $dateTime = strtotime($dateTime);
     return date('j',$dateTime).' '.$month[date('n',$dateTime)].' '.(date('Y',$dateTime)+543);
  }
  function thaiDateTime($dateTime){
    return thaiDate($dateTime).' '.date('H:i',strtotime($dateTime));
  }
  function thaiDate_Full($dateTime){
     $dateTime = strtotime($dateTime);
     return date('j',$dateTime).' '.thaiMonthFull(date('m',$dateTime)).' '.(date('Y',$dateTime)+543);
  }
  function thaiDate_FullYdm($dateTime){
     $dateTime = substr($dateTime,8,2).'-'.substr($dateTime,5,2).'-'.substr($dateTime,0,4);
     $dateTime = strtotime($dateTime);
     return date('j',$dateTime).' '.thaiMonthFull(date('m',$dateTime)).' '.(date('Y',$dateTime)+543);
  }

  function thaiMonthFull($month){
    $thaiMonthFull = array(
     "01"=>"มกราคม",
     "02"=>"กุมภาพันธ์",
     "03"=>"มีนาคม",
     "04"=>"เมษายน",
     "05"=>"พฤษภาคม",
     "06"=>"มิถุนายน",
     "07"=>"กรกฎาคม",
     "08"=>"สิงหาคม",
     "09"=>"กันยายน",
     "10"=>"ตุลาคม",
     "11"=>"พฤศจิกายน",
     "12"=>"ธันวาคม"
   );
   return $thaiMonthFull[$month];
  }

  function thaiDigit($num){
    return str_replace(array( '0' , '1' , '2' , '3' , '4' , '5' , '6' ,'7' , '8' , '9' ),
   array( "o" , "๑" , "๒" , "๓" , "๔" , "๕" , "๖" , "๗" , "๘" , "๙" ),
   $num);
  }

  function numberToThaiText($number) {
    $number = number_format($number, 2, '.', '');
    $numberx = $number;
    $txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ');
    $txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน');
    $number = str_replace(",","",$number);
    $number = str_replace(" ","",$number);
    $number = str_replace("บาท","",$number);
    $number = explode(".",$number);
    if(sizeof($number)>2){
      return 'ทศนิยมหลายตัวนะจ๊ะ';
      exit;
    }
    $strlen = strlen($number[0]);
    $convert = '';
    for($i=0;$i<$strlen;$i++){
       $n = substr($number[0], $i,1);
       if($n!=0){
         if($i==($strlen-1) AND $n==1){
           $convert .= 'เอ็ด'; }
         elseif($i==($strlen-2) AND $n==2){
           $convert .= 'ยี่'; }
         elseif($i==($strlen-2) AND $n==1){
           $convert .= ''; }
         else{
           $convert .= $txtnum1[$n]; }
           $convert .= $txtnum2[$strlen-$i-1];
       }
    }

    $convert .= 'บาท';
    if($number[1]=='0' OR $number[1]=='00' OR
      $number[1]==''){
      $convert .= 'ถ้วน';
    }else{
      $strlen = strlen($number[1]);
      for($i=0;$i<$strlen;$i++){
        $n = substr($number[1], $i,1);
        if($n!=0){
          if($i==($strlen-1) AND $n==1){
            $convert .= 'เอ็ด';
          }
          elseif($i==($strlen-2) AND $n==2){
            $convert .= 'ยี่';
          }
          elseif($i==($strlen-2) AND $n==1){
            $convert .= '';
          }else{
             $convert .= $txtnum1[$n];
          }
          $convert .= $txtnum2[$strlen-$i-1];
        }
      }
    $convert .= 'สตางค์';
    }
    //แก้ต่ำกว่า 1 บาท ให้แสดงคำว่าศูนย์ แก้ ศูนย์บาท
    if($numberx < 1){
     $convert = "ศูนย์" .  $convert;
    }

    //แก้เอ็ดสตางค์
    $len = strlen($numberx);
    $lendot1 = $len - 2;
    $lendot2 = $len - 1;
    if(($numberx[$lendot1] == 0) && ($numberx[$lendot2] == 1)) {
       $convert = substr($convert,0,-10);
       $convert = $convert . "หนึ่งสตางค์";
    }

    //แก้เอ็ดบาท สำหรับค่า 1-1.99
    if($numberx >= 1){
      if($numberx < 2){
        $convert = substr($convert,4);
        $convert = "หนึ่ง" .  $convert;
      }
    }
    return $convert;
   }

}

?>
