<?php

namespace app\models\common;

use Yii;
use yii\base\Model;

class JsonObj extends Model {
	/***
	 *  1: successfully
	 * -1: failed
	 * @var $status
	 */
	public $status;
	public $err;
	public $value;
	public function __construct($status, $err, $value) {
		$this->status = $status;
		$this->err = $err;
		$this->value = $value;
	}
}