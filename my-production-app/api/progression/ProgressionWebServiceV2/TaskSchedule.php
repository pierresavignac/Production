<?php

namespace ProgressionWebService;

class TaskSchedule extends Record
{

    /**
     * @var TaskScheduleType $Type
     */
    protected $Type = null;

    /**
     * @var \DateTime $Next
     */
    protected $Next = null;

    /**
     * @var time $Time
     */
    protected $Time = null;

    /**
     * @var \DateTime $Start
     */
    protected $Start = null;

    /**
     * @var \DateTime $End
     */
    protected $End = null;

    /**
     * @var TaskScheduleTemplate $TaskScheduleTemplate
     */
    protected $TaskScheduleTemplate = null;

    /**
     * @var string $CronExpression
     */
    protected $CronExpression = null;

    /**
     * @var boolean $AutoDispatch
     */
    protected $AutoDispatch = null;

    /**
     * @var int $MsInAdvance
     */
    protected $MsInAdvance = null;

    /**
     * @var string $DayOfWeek
     */
    protected $DayOfWeek = null;

    /**
     * @var int $DayOfMonth
     */
    protected $DayOfMonth = null;

    /**
     * @var int $TypeRepeat
     */
    protected $TypeRepeat = null;

    /**
     * @param int $Id
     * @param string $UID
     * @param string $ExternalId
     * @param \DateTime $removed
     * @param anySimpleType $updated
     * @param anySimpleType $created
     * @param string $CronExpression
     * @param boolean $AutoDispatch
     * @param int $MsInAdvance
     * @param string $DayOfWeek
     * @param int $DayOfMonth
     * @param int $TypeRepeat
     */
    public function __construct($Id = null, $UID = null, $ExternalId = null, \DateTime $removed = null, $updated = null, $created = null, $CronExpression = null, $AutoDispatch = null, $MsInAdvance = null, $DayOfWeek = null, $DayOfMonth = null, $TypeRepeat = null)
    {
      parent::__construct($Id, $UID, $ExternalId, $removed, $updated, $created);
      $this->CronExpression = $CronExpression;
      $this->AutoDispatch = $AutoDispatch;
      $this->MsInAdvance = $MsInAdvance;
      $this->DayOfWeek = $DayOfWeek;
      $this->DayOfMonth = $DayOfMonth;
      $this->TypeRepeat = $TypeRepeat;
    }

    /**
     * @return TaskScheduleType
     */
    public function getType()
    {
      return $this->Type;
    }

    /**
     * @param TaskScheduleType $Type
     * @return \ProgressionWebService\TaskSchedule
     */
    public function setType($Type)
    {
      $this->Type = $Type;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getNext()
    {
      if ($this->Next == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->Next);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $Next
     * @return \ProgressionWebService\TaskSchedule
     */
    public function setNext(\DateTime $Next = null)
    {
      if ($Next == null) {
       $this->Next = null;
      } else {
        $this->Next = $Next->format(\DateTime::ATOM);
      }
      return $this;
    }

    /**
     * @return time
     */
    public function getTime()
    {
      return $this->Time;
    }

    /**
     * @param time $Time
     * @return \ProgressionWebService\TaskSchedule
     */
    public function setTime($Time)
    {
      $this->Time = $Time;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStart()
    {
      if ($this->Start == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->Start);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $Start
     * @return \ProgressionWebService\TaskSchedule
     */
    public function setStart(\DateTime $Start = null)
    {
      if ($Start == null) {
       $this->Start = null;
      } else {
        $this->Start = $Start->format(\DateTime::ATOM);
      }
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEnd()
    {
      if ($this->End == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->End);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $End
     * @return \ProgressionWebService\TaskSchedule
     */
    public function setEnd(\DateTime $End = null)
    {
      if ($End == null) {
       $this->End = null;
      } else {
        $this->End = $End->format(\DateTime::ATOM);
      }
      return $this;
    }

    /**
     * @return TaskScheduleTemplate
     */
    public function getTaskScheduleTemplate()
    {
      return $this->TaskScheduleTemplate;
    }

    /**
     * @param TaskScheduleTemplate $TaskScheduleTemplate
     * @return \ProgressionWebService\TaskSchedule
     */
    public function setTaskScheduleTemplate($TaskScheduleTemplate)
    {
      $this->TaskScheduleTemplate = $TaskScheduleTemplate;
      return $this;
    }

    /**
     * @return string
     */
    public function getCronExpression()
    {
      return $this->CronExpression;
    }

    /**
     * @param string $CronExpression
     * @return \ProgressionWebService\TaskSchedule
     */
    public function setCronExpression($CronExpression)
    {
      $this->CronExpression = $CronExpression;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getAutoDispatch()
    {
      return $this->AutoDispatch;
    }

    /**
     * @param boolean $AutoDispatch
     * @return \ProgressionWebService\TaskSchedule
     */
    public function setAutoDispatch($AutoDispatch)
    {
      $this->AutoDispatch = $AutoDispatch;
      return $this;
    }

    /**
     * @return int
     */
    public function getMsInAdvance()
    {
      return $this->MsInAdvance;
    }

    /**
     * @param int $MsInAdvance
     * @return \ProgressionWebService\TaskSchedule
     */
    public function setMsInAdvance($MsInAdvance)
    {
      $this->MsInAdvance = $MsInAdvance;
      return $this;
    }

    /**
     * @return string
     */
    public function getDayOfWeek()
    {
      return $this->DayOfWeek;
    }

    /**
     * @param string $DayOfWeek
     * @return \ProgressionWebService\TaskSchedule
     */
    public function setDayOfWeek($DayOfWeek)
    {
      $this->DayOfWeek = $DayOfWeek;
      return $this;
    }

    /**
     * @return int
     */
    public function getDayOfMonth()
    {
      return $this->DayOfMonth;
    }

    /**
     * @param int $DayOfMonth
     * @return \ProgressionWebService\TaskSchedule
     */
    public function setDayOfMonth($DayOfMonth)
    {
      $this->DayOfMonth = $DayOfMonth;
      return $this;
    }

    /**
     * @return int
     */
    public function getTypeRepeat()
    {
      return $this->TypeRepeat;
    }

    /**
     * @param int $TypeRepeat
     * @return \ProgressionWebService\TaskSchedule
     */
    public function setTypeRepeat($TypeRepeat)
    {
      $this->TypeRepeat = $TypeRepeat;
      return $this;
    }

}
