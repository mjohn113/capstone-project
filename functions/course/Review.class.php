<?php

/**
 * A model class for a review
 */
class Review
{
    private $name;
    private $rating;
    private $semester;
    private $instructor;
    private $campus;
    private $description;

    /**
     * Review constructor
     * @param $name
     *  The display name of a user
     * @param $rating
     *  The rating (1-5) of a review
     * @param $semester
     *  The semester a review was written for
     * @param $instructor
     *  The instructor a user had
     * @param $campus
     *  The campus a class was taken at
     */
    public function __construct($name, $rating, $semester, $instructor, $campus, $description)
    {
        $this->name = $name;
        $this->rating = $rating;
        $this->semester = $semester;
        $this->instructor = $instructor;
        $this->campus = $campus;
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    public function getSemester()
    {
        return $this->semester;
    }

    public function setSemester($semester)
    {
        $this->semester = $semester;
    }

    public function getInstructor()
    {
        return $this->instructor;
    }

    public function setInstructor($instructor)
    {
        $this->instructor = $instructor;
    }

    public function getCampus()
    {
        return $this->campus;
    }

    public function setCampus($campus)
    {
        $this->campus = $campus;
    }


}