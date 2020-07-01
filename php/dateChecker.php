<?php
namespace Test\apps;

use \DateTime;

class DateChecker
{
    public $target_date_time;
    public $week = ["日", "月", "火", "水", "木", "金", "土"];

    /**
     *比較対象Datetimeをセット(引数無しだと現在時刻)
     * @param DateTime $datetime default:null
     */
    public function setTargetDateTime($datetime=null)
    {
        if (!empty($datetime)&&$datetime instanceof DateTime) {
            $this->target_date_time=$datetime;
        } else {
            $this->target_date_time=new DateTime();
        }
    }
    /**
     * 比較対象Datetimeを取得(なければ現在時刻をセットする)
     * @return DateTime
     * $date_checker->getTargetDateTime()->format('Y-m-d H:i:s')
     */
    public function getTargetDateTime()
    {
        if (empty($this->target_date_time)|| !$this->target_date_time instanceof DateTime) {
            $this->setTargetDateTime();
        }
        return $this->target_date_time;
    }

    public function __construct($datetime=null)
    {
        $this->setTargetDateTime($datetime);
    }

    /**
     * 比較対象Datetimeが期間内であればtrueを返す
     * $start_time <= $end_time
     * @param DateTime $start_time
     * @param DateTime $end_time
     * @return bool
     * $date_checker->isPeriodOfTime(new DateTime('2020-07-01'), new DateTime('2020-07-02'))
     */
    public function isPeriodOfTime($start_time, $end_time)
    {
        if (!$start_time instanceof DateTime ||!$end_time instanceof DateTime ||!($start_time <= $end_time)) {
            return false;
        }
        if ($this->getTargetDateTime()>=$start_time && $this->getTargetDateTime()<=$end_time) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * 比較対象Datetimeが引数曜日であればtrueを返す
     * @param String $week_day_name "日"| "月"| "火"|"水"| "木"| "金"| "土"
     * @return bool
     * $date_checker->isWeekDay("水")
     */
    public function isWeekDay($week_day_name)
    {
        if (!in_array($week_day_name, $this->week, true)) {
            return false;
        }
        $w = (int)$this->getTargetDateTime()->format('w');
        if ($this->week[$w]===$week_day_name) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * 比較対象Datetimeが引数数字＊月or日or時であればtrueを返す
     * @param int $num
     * @param String $type 'm'|'d'|'H' default='m'
     * @return bool
     * $date_checker->isMDHNum('07')&&$date_checker->isMDHNum('01', 'd')&&$date_checker->isMDHNum('13', 'H')
     */
    public function isMDHNum($num, $format_type='m')
    {
        if (!in_array($format_type, ['m','d','H'], true)) {
            return false;
        }
        $num = sprintf('%02d', $num);
        $target_num = $this->getTargetDateTime()->format($format_type);
        echo('$target_num');
        echo($target_num);
        if ($num===$target_num) {
            return true;
        } else {
            return false;
        }
    }
}
