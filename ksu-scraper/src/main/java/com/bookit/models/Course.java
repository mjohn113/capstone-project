package com.bookit.models;

import java.sql.Date;
import java.util.ArrayList;
import java.util.Objects;

public class Course {
    private String crn;
    private String course;
    private String campus;
    private String credits;
    private String title;
    private String enrolled;
    private String remainOpen;
    private String instructor;
    private Date startDate;
    private Date endDate;
    private String location;
    private java.util.Date startTime;
    private java.util.Date endTime;
    private String meetDays;
    private String description;

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    @Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;
        Course course1 = (Course) o;
        return Objects.equals(crn, course1.crn) &&
                Objects.equals(course, course1.course) &&
                Objects.equals(campus, course1.campus) &&
                Objects.equals(credits, course1.credits) &&
                Objects.equals(title, course1.title) &&
                Objects.equals(enrolled, course1.enrolled) &&
                Objects.equals(remainOpen, course1.remainOpen) &&
                Objects.equals(instructor, course1.instructor) &&
                Objects.equals(startDate, course1.startDate) &&
                Objects.equals(endDate, course1.endDate) &&
                Objects.equals(location, course1.location) &&
                Objects.equals(startTime, course1.startTime) &&
                Objects.equals(endTime, course1.endTime) &&
                Objects.equals(meetDays, course1.meetDays);
    }

    @Override
    public int hashCode() {

        return Objects.hash(crn, course, campus, credits, title, enrolled, remainOpen, instructor, startDate, endDate, location, startTime, endTime, meetDays);
    }

    public java.util.Date getStartTime() {
        return startTime;
    }

    public void setStartTime(java.util.Date startTime) {
        this.startTime = startTime;
    }

    public java.util.Date getEndTime() {
        return endTime;
    }

    public void setEndTime(java.util.Date endTime) {
        this.endTime = endTime;
    }

    public String getInstructor() {
        return instructor;
    }

    public void setInstructor(String instructor) {
        this.instructor = instructor;
    }

    public Date getStartDate() {
        return startDate;
    }

    public void setStartDate(Date startDate) {
        this.startDate = startDate;
    }

    public Date getEndDate() {
        return endDate;
    }

    public void setEndDate(Date endDate) {
        this.endDate = endDate;
    }

    public String getLocation() {
        return location;
    }

    public void setLocation(String location) {
        this.location = location;
    }

    public String getMeetDays() {
        return meetDays;
    }

    public void setMeetDays(String meetDays) {
        this.meetDays = meetDays;
    }

    public String getCrn() {
        return crn;
    }

    public void setCrn(String crn) {
        this.crn = crn;
    }

    public String getCourse() {
        return course;
    }

    public void setCourse(String course) {
        this.course = course;
    }

    public String getCampus() {
        return campus;
    }

    public void setCampus(String campus) {
        this.campus = campus;
    }

    public String getCredits() {
        return credits;
    }

    public void setCredits(String credits) {
        this.credits = credits;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getEnrolled() {
        return enrolled;
    }

    public void setEnrolled(String enrolled) {
        this.enrolled = enrolled;
    }

    public String getRemainOpen() {
        return remainOpen;
    }

    public void setRemainOpen(String remainOpen) {
        this.remainOpen = remainOpen;
    }

    @Override
    public String toString() {
        return "Course{" +
                "crn='" + crn + '\'' +
                ", course='" + course + '\'' +
                ", campus='" + campus + '\'' +
                ", credits='" + credits + '\'' +
                ", title='" + title + '\'' +
                ", enrolled='" + enrolled + '\'' +
                ", remainOpen='" + remainOpen + '\'' +
                ", instructor='" + instructor + '\'' +
                ", startDate=" + startDate +
                ", endDate=" + endDate +
                ", location='" + location + '\'' +
                ", startTime='" + startTime + '\'' +
                ", endTime='" + endTime + '\'' +
                ", meetDays='" + meetDays + '\'' +
                '}';
    }
}
