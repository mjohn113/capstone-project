<?php

/**
 * A model class for a course
 */
class Course
{
    private $crn;
    private $course;
    private $campus;
    private $credits;
    private $title;
    private $enrolled;
    private $remainOpen;
    private $instructor;
    private $startDate;
    private $endDate;
    private $location;
    private $startTime;
    private $endTime;
    private $meetDays;

    /**
     * Course constructor
     * @param $crn
     *  The CRN number of the class
     * @param $course
     *  The course ID of the class
     * @param $campus
     *  The campus the class is taught at
     * @param $credits
     *  The amount of credit hours of the class
     * @param $title
     *  The title of the class
     * @param $enrolled
     *  Amount of students currently enrolled in the class
     * @param $remainOpen
     *  Remaining amount of students that can enroll in the class
     * @param $instructor
     *  The instructor that teaches the class
     * @param $startDate
     *  The start date of the class formatted YYYY-MM-DD
     * @param $endDate
     *  The end date of the class formatted YYYY-MM-DD
     * @param $location
     *  The location the class meets on campus
     * @param $startTime
     *  The start time of the class
     * @param $endTime
     *  The end time of the class
     * @param $meetDays
     *  The days the class meets
     */
    public function __construct($crn, $course, $campus, $credits, $title, $enrolled, $remainOpen, $instructor, $startDate, $endDate, $location, $startTime, $endTime, $meetDays)
    {
        $this->crn = $crn;
        $this->course = $course;
        $this->campus = $campus;
        $this->credits = $credits;
        $this->title = $title;
        $this->enrolled = $enrolled;
        $this->remainOpen = $remainOpen;
        $this->instructor = $instructor;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->location = $location;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->meetDays = $meetDays;
    }

    public function getCrn()
    {
        return $this->crn;
    }

    public function setCrn($crn)
    {
        $this->crn = $crn;
    }

    public function getCourse()
    {
        return $this->course;
    }

    public function setCourse($course)
    {
        $this->course = $course;
    }

    public function getCampus()
    {
        return $this->campus;
    }

    public function setCampus($campus)
    {
        $this->campus = $campus;
    }

    public function getCredits()
    {
        return $this->credits;
    }

    public function setCredits($credits)
    {
        $this->credits = $credits;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getEnrolled()
    {
        return $this->enrolled;
    }

    public function setEnrolled($enrolled)
    {
        $this->enrolled = $enrolled;
    }

    public function getRemainOpen()
    {
        return $this->remainOpen;
    }

    public function setRemainOpen($remainOpen)
    {
        $this->remainOpen = $remainOpen;
    }

    public function getInstructor()
    {
        return $this->instructor;
    }

    public function setInstructor($instructor)
    {
        $this->instructor = $instructor;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function getStartTime()
    {
        return $this->startTime;
    }

    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    public function getEndTime()
    {
        return $this->endTime;
    }

    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
    }

    public function getMeetDays()
    {
        return $this->meetDays;
    }

    public function setMeetDays($meetDays)
    {
        $this->meetDays = $meetDays;
    }

}