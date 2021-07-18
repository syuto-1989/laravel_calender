<?php
namespace App\Calendar\Output;
use Carbon\Carbon;
use App\Calendar\CalendarView;
use App\Calendar\CalendarWeekDay;
/**
* 表示用
*/
class CalendarOutputView extends CalendarView {
	
	/**
	 * 日を描画する
	 */
	protected function renderDay(CalendarWeekDay $day){

		$html = [];
		$extraHoliday = null;

		//臨時営業日設定で上書き
		if(isset($this->holidays[$day->getDateKey()])){
			$extraHoliday = $this->holidays[$day->getDateKey()];
			if($extraHoliday->isOpen()){
				$day->setHoliday(false);
			}else if($extraHoliday->isClose()){
				$day->setHoliday(true);
			}
		}
        $todayClass = '';
        $date_key = $day->getDateKey();
        if($date_key == date('Ymd')){
            $todayClass = 'today';
        }

		$html[] = '<td class="'.$day->getClassName().' '.$todayClass.'">';
		$html[] = $day->render();
        $html[] = '<a class="edit" href="/extra_holiday_setting/edit/'.$day->getDateKey().'">編集</a>';
        $html[] = '<button class="ajaxBtn btn" id="ajaxBtn">表示</button>';
        $html[] = '<input type="hidden" name="date_key" value="'.$day->getDateKey().'">';
        //コメントを表示
		if($extraHoliday){
			$html[] = '<p class="comment">' . e($extraHoliday->comment) . '</p>';
		}

        $html[] = '</td>';

		return implode("", $html);
	}
}