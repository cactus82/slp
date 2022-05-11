<?php
namespace App\GeneralClass;
use Carbon\Carbon;

Class PermitLicenseNumber{
    public static function GenerateLicenseNumber($kodPejabat,$jenisLesen,$category,$type,$runningId){
        $yr = Carbon::now()->format('Y');
        $str = "JHL.".$kodPejabat.".600-".$jenisLesen."/".$category."/".$yr."/".$type."/".$runningId;
        return $str;
    }
}

?>
