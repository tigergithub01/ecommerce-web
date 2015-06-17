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
	public $msg;
	public $value;
	public function __construct($status, $msg, $value) {
		$this->status = $status;
		$this->msg = $msg;
		$this->value = $value;
	}
}