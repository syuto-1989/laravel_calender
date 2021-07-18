<?php

namespace App\Calendar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraHoliday extends Model
{
	const OPEN = 1;
	const CLOSE = 2;
	protected $table = "extra_holiday";

	protected $fillable = [
		"date_key",
		//"date_flag",
		//"comment",
		"schedule_comment",
		"schedule_time",
	];

	function isClose(){
		return $this->date_flag == ExtraHoliday::CLOSE;
	}
	function isOpen(){
		return $this->date_flag == ExtraHoliday::OPEN;
	}


	/**
	 * 指定した月の臨時営業・休業を取得する
	 * @return ExtraHoliday[]
	 */
	public static function getExtraHolidayWithMonth($ym){
		return ExtraHoliday::where("date_key", 'like', $ym . '%')
            ->get()->keyBy("date_key");
	}

    public static function storeSchedule($date_key, $schedule, $schedule_time, $user_id){
        $schedule_db = new ExtraHoliday();
        $schedule_db->date_key = $date_key;
        $schedule_db->schedule_comment = $schedule;
        $schedule_db->schedule_time = $schedule_time;
				$schedule_db->user_id = $user_id;
        $schedule_db->save();
	}

    public static function updateSchedule($schedule, $schedule_time, $id){
        $schedule_db = ExtraHoliday::where('id', $id)->first();
        $schedule_db->schedule_comment = $schedule;
        $schedule_db->schedule_time = $schedule_time;
        $schedule_db->save();
	}

    public static function getDatekeyById($id){
         $date_key_data = ExtraHoliday::select('date_key')->where('id', $id)->first();
         $date_key = $date_key_data->date_key;
         return $date_key;
	}

	public function user()
	{
	    return $this->belongsTo('App\Models\User');
	}

	/**
	 * 一括で更新する
	 */

	public static function updateExtraHolidayWithMonth($ym, $input){

		$extreaHolidays = self::getExtraHolidayWithMonth($ym);

		foreach($input as $date_key => $array){

			if(isset($extreaHolidays[$date_key])){	//既に作成済の場合

				$extraHoliday = $extreaHolidays[$date_key];
				$extraHoliday->fill($array);

				//CloseかOpen指定の場合は上書き
				if($extraHoliday->isClose() || $extraHoliday->isOpen()){
					$extraHoliday->save();

				//指定なしを選択している場合は削除
				}else{
					$extraHoliday->delete();
				}
				continue;
			}

			$extraHoliday = new ExtraHoliday();
			$extraHoliday->date_key = $date_key;
			$extraHoliday->fill($array);

			//CloseかOpen指定の場合は保存
			if($extraHoliday->isClose() || $extraHoliday->isOpen()){
				$extraHoliday->save();
			}
		}
	}
}
