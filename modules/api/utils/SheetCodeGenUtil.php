<?php

namespace app\modules\api\utils;

use app\models\system\SheetType;

class SheetCodeGenUtil {
	public static function  getCode($sheetTypeId) {
		//generate code
		$sheetType = SheetType::findOne ( $sheetTypeId );
		$df = date ( $sheetType ['date_format'], time () );
		$seq = sprintf ( '%0' . $sheetType ['seq_length'] . 's', $sheetType ['cur_seq'] );
		$code = $sheetType ['prefix'] . $sheetType ['sep'] . $df . $sheetType ['sep'] . $seq;
		
		//increment cur_seq field
		$sheetType->cur_seq = ($sheetType->cur_seq + 1);
		$sheetType->save();
		
		return $code;
		
	}
}