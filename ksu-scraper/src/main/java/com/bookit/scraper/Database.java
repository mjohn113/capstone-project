package com.bookit.scraper;

import com.bookit.models.Book;
import com.bookit.models.Course;
import com.bookit.models.Notification;
import com.bookit.models.User;

import java.sql.*;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;

public class Database {

    private final String url;
    private final String user;
    private final String password;

    public Database(String url, String user, String password) {
        this.url = url;
        this.user = user;
        this.password = password;
    }

    private Connection createConnection() {
        Connection con = null;
        try {
            con = DriverManager.getConnection(url, user, password);
        }
        catch (Exception ex) {
            ex.printStackTrace();
        }
        return con;
    }

    public boolean isInTable (String crn) throws Exception {
        Connection con = null;
        boolean result = true;
        String query = "SELECT * FROM tblClasses WHERE crn = ?";

        try {
            con = createConnection();

            PreparedStatement ps = con.prepareStatement(query);

            ps.setString(1, crn);
            ResultSet rs = ps.executeQuery();
            result = rs.next();
        }
        catch (Exception ex) {
            ex.printStackTrace();
        }
        finally {
            try {
                if (con != null) { con.close(); }
            }
            catch (Exception ex) {
                ex.printStackTrace();
            }
        }

        return result;

    }

    public boolean isInTable (Book book) throws Exception {
        Connection con = null;
        boolean result = true;
        String query = "SELECT * FROM tblBooks WHERE isbn = ?";

        try {
            con = createConnection();

            PreparedStatement ps = con.prepareStatement(query);

            ps.setString(1, book.getIsbn());
            ResultSet rs = ps.executeQuery();
            result = rs.next();
        }
        catch (Exception ex) {
            ex.printStackTrace();
        }
        finally {
            try {
                if (con != null) { con.close(); }
            }
            catch (Exception ex) {
                ex.printStackTrace();
            }
        }

        return result;
    }

    public void updateInDatabase(Course aCourse) {
        Connection con = null;
        System.out.println("Updating: " + aCourse.toString() + "\n");

        String query = "UPDATE tblClasses SET courseID = ?, title = ?, campus = ?, credits = ?, totalSeats = ?, seatsRemaining = ?, " +
                "lastUpdated = ?, instructor = ?, location = ?, meetDays = ?, startDate = ?, endDate = ?, startTime = ?, " +
                "endTime = ?, description = ? WHERE crn = ?";

        try {
            con = createConnection();

            PreparedStatement ps = con.prepareStatement(query);

            ps.setString(1, aCourse.getCourse());
            ps.setString(2, aCourse.getTitle());
            ps.setString(3, aCourse.getCampus());
            ps.setString(4, aCourse.getCredits());
            ps.setString(5, aCourse.getEnrolled());
            ps.setString(6, aCourse.getRemainOpen());
            ps.setString(7, new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(new Date()));
            ps.setString(8, aCourse.getInstructor());
            ps.setString(9, aCourse.getLocation());
            ps.setString(10, aCourse.getMeetDays());
            ps.setDate(11, aCourse.getStartDate());
            ps.setDate(12, aCourse.getEndDate());

            if (aCourse.getStartTime() == null)
                ps.setTime(13, null);
            else
                ps.setTime(13, new Time(aCourse.getStartTime().getTime()));
            if (aCourse.getEndTime() == null)
                ps.setTime(14, null);
            else
                ps.setTime(14, new Time(aCourse.getEndTime().getTime()));

            ps.setString(15, aCourse.getDescription());
            ps.setString(16, aCourse.getCrn());

            ps.executeUpdate();
        }
        catch (Exception ex) {
            ex.printStackTrace();
        }
        finally {
            try {
                if (con != null) { con.close(); }
            }
            catch (Exception ex) {
                ex.printStackTrace();
            }
        }


    }

    public void insertInDatabase(Course aCourse) {
        Connection con = null;
        System.out.println("Inserting: " + aCourse.toString() + "\n");

        String query = "INSERT INTO tblClasses (instructor, location, startDate, endDate, startTime, endTime, " +
                "meetDays, crn, courseID, title, credits, campus, totalSeats, seatsRemaining, lastUpdated) " +
                "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            con = createConnection();

            PreparedStatement ps = con.prepareStatement(query);

            ps.setString(1, aCourse.getInstructor());
            ps.setString(2, aCourse.getLocation());
            ps.setDate(3, aCourse.getStartDate());
            ps.setDate(4, aCourse.getEndDate());
            if (aCourse.getStartTime() == null)
                ps.setTime(5, null);
            else
                ps.setTime(5, new Time(aCourse.getStartTime().getTime()));
            if (aCourse.getEndTime() == null)
                ps.setTime(6, null);
            else
                ps.setTime(6, new Time(aCourse.getEndTime().getTime()));
            ps.setString(7, aCourse.getMeetDays());
            ps.setString(8, aCourse.getCrn());
            ps.setString(9, aCourse.getCourse());
            ps.setString(10, aCourse.getTitle());
            ps.setString(11, aCourse.getCredits());
            ps.setString(12, aCourse.getCampus());
            ps.setString(13, aCourse.getEnrolled());
            ps.setString(14, aCourse.getRemainOpen());
            ps.setString(15, new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(new Date()));

            ps.executeUpdate();
        }
        catch (Exception ex) {
            ex.printStackTrace();
        }
        finally {
            try {
                if (con != null) { con.close(); }
            }
            catch (Exception ex) {
                ex.printStackTrace();
            }
        }

    }

    public void insertBookInDatabase(Course aCourse, Book aBook) {
        Connection con = null;
        PreparedStatement ps;

        String query = "INSERT INTO tblBooks (isbn, title, author, edition, publisher) " +
                "VALUES (?, ?, ?, ?, ?)";

        String query2 = "INSERT INTO tblClassRequiresBook (bookISBN, classCRN) " +
                "VALUES (?, ?)";

        System.out.println("Inserting: " + aBook.getIsbn() + " for classs: " + aCourse.getCrn());

        try {
            con = createConnection();

            if (!isInTable(aBook)) {
                ps = con.prepareStatement(query);
                ps.setString(1, aBook.getIsbn());
                ps.setString(2, aBook.getTitle());
                ps.setString(3, aBook.getAuthor());
                ps.setString(4, aBook.getEditor());
                ps.setString(5, aBook.getPublisher());
                ps.executeUpdate();
            }

            ps = con.prepareStatement(query2);
            ps.setString(1, aBook.getIsbn());
            ps.setString(2, aCourse.getCrn());

            ps.executeUpdate();

        }
        catch (Exception ex) {
            ex.printStackTrace();
        }
        finally {
            try {
                if (con != null) { con.close(); }
            }
            catch (Exception ex) {
                ex.printStackTrace();
            }
        }

    }

    public void insertBookInRequiredTbl(Course aCourse, Book aBook) {
        Connection con = null;
        PreparedStatement ps;

        System.out.println("Inserting: " + aBook.getIsbn() + " for classs: " + aCourse.getCrn());

        String query = "INSERT INTO tblClassRequiresBook (bookISBN, classCRN) " +
                "VALUES (?, ?)";

        try {
            con = createConnection();

            ps = con.prepareStatement(query);
            ps.setString(1, aBook.getIsbn());
            ps.setString(2, aCourse.getCrn());
            ps.executeUpdate();

        }
        catch (Exception ex) {
            ex.printStackTrace();
        }
        finally {
            try {
                if (con != null) { con.close(); }
            }
            catch (Exception ex) {
                ex.printStackTrace();
            }
        }
    }

    public Course getCourse(String crn) {
        Connection con = null;
        Course aCourse = new Course();
        String query = "SELECT crn, courseID, title, instructor, credits, campus, location, startDate, endDate, " +
                "startTime, endTime, meetDays, totalSeats, seatsRemaining FROM tblClasses WHERE crn = ?";

        try {
            con = createConnection();

            PreparedStatement ps = con.prepareStatement(query);
            ps.setString(1, crn);

            ResultSet rs = ps.executeQuery();
            rs.next();

            aCourse.setCrn(rs.getString(1));
            aCourse.setCourse(rs.getString(2));
            aCourse.setTitle(rs.getString(3));
            aCourse.setInstructor(rs.getString(4));
            aCourse.setCredits(rs.getString(5));
            aCourse.setCampus(rs.getString(6));
            aCourse.setLocation(rs.getString(7));
            aCourse.setStartDate(rs.getDate(8));
            aCourse.setEndDate(rs.getDate(9));
            aCourse.setStartTime(rs.getTime(10));
            aCourse.setEndTime(rs.getTime(11));
            aCourse.setMeetDays(rs.getString(12));
            aCourse.setEnrolled(rs.getString(13));
            aCourse.setRemainOpen(rs.getString(14));

        }
        catch (Exception ex) {
            ex.printStackTrace();
        }
        finally {
            try {
                if (con != null) { con.close(); }
            }
            catch (Exception ex) {
                ex.printStackTrace();
            }
        }

        return aCourse;
    }

    public ArrayList<Course> getCourses() {
        Connection con = null;
        ArrayList<Course> courses = new ArrayList<Course>();

        String query = "SELECT crn, courseID, title, instructor, credits, campus, location, startDate, endDate, " +
                "startTime, endTime, meetDays, totalSeats, seatsRemaining FROM tblClasses";

        try {
            con = createConnection();

            PreparedStatement ps = con.prepareStatement(query);

            ResultSet rs = ps.executeQuery();

            while (rs.next()) {
                Course aCourse = new Course();

                aCourse.setCrn(rs.getString(1));
                aCourse.setCourse(rs.getString(2));
                aCourse.setTitle(rs.getString(3));
                aCourse.setInstructor(rs.getString(4));
                aCourse.setCredits(rs.getString(5));
                aCourse.setCampus(rs.getString(6));
                aCourse.setLocation(rs.getString(7));
                aCourse.setStartDate(rs.getDate(8));
                aCourse.setEndDate(rs.getDate(9));
                aCourse.setStartTime(rs.getTime(10));
                aCourse.setEndTime(rs.getTime(11));
                aCourse.setMeetDays(rs.getString(12));
                aCourse.setEnrolled(rs.getString(13));
                aCourse.setRemainOpen(rs.getString(14));

                courses.add(aCourse);
            }

        }
        catch (Exception ex) {
            ex.printStackTrace();
        }
        finally {
            try {
                if (con != null) { con.close(); }
            }
            catch (Exception ex) {
                ex.printStackTrace();
            }
        }

        return courses;
    }

    public ArrayList<User> getUsersSubscribedTo(String crn) {
        Connection con = null;
        ArrayList<User> users = new ArrayList<User>();
        String query = "SELECT email FROM tblUserRegisteredClasses WHERE classCrn = ?";

        try {
            con = createConnection();

            PreparedStatement ps = con.prepareStatement(query);

            ps.setString(1, crn);
            ResultSet rs = ps.executeQuery();

            while (rs.next()) {
                User aUser = new User();
                aUser.setEmail(rs.getString(1));
                users.add(aUser);
            }
        }
        catch (Exception ex) {
            ex.printStackTrace();
        }
        finally {
            try {
                if (con != null) { con.close(); }
            }
            catch (Exception ex) {
                ex.printStackTrace();
            }
        }

        return users;
    }

    public boolean userHasNotificationFor(Notification notification) throws Exception {
        Connection con = null;
        boolean result = false;
        String query = "SELECT * FROM tblUserNotification WHERE notificationType = ? AND email = ?";

        try {
            con = createConnection();

            PreparedStatement ps = con.prepareStatement(query);

            ps.setString(1, notification.getNotificationType());
            ps.setString(2, notification.getEmail());
            ResultSet rs = ps.executeQuery();
            result = rs.next();
        }
        catch (Exception ex) {
            ex.printStackTrace();
        }
        finally {
            try {
                if (con != null) { con.close(); }
            }
            catch (Exception ex) {
                ex.printStackTrace();
            }
        }

        return result;

    }

    public ArrayList<Course> getClassesWithoutBooks() {
        Connection con = null;

        ArrayList<Course> courses = new ArrayList<Course>();
        String query = "SELECT * FROM tblClasses t1 WHERE NOT EXISTS (SELECT classCRN FROM tblClassRequiresBook t2 WHERE t1.crn = t2.classCRN)";

        try {
            con = createConnection();

            PreparedStatement ps = con.prepareStatement(query);

            ResultSet rs = ps.executeQuery();

            while (rs.next()) {
                Course aCourse = new Course();

                aCourse.setCrn(rs.getString(1));
                aCourse.setCourse(rs.getString(2));
                aCourse.setTitle(rs.getString(3));
                aCourse.setInstructor(rs.getString(4));
                aCourse.setCredits(rs.getString(5));
                aCourse.setCampus(rs.getString(6));
                aCourse.setLocation(rs.getString(7));
                aCourse.setStartDate(rs.getDate(8));
                aCourse.setEndDate(rs.getDate(9));
                aCourse.setStartTime(rs.getTime(10));
                aCourse.setEndTime(rs.getTime(11));
                aCourse.setMeetDays(rs.getString(12));
                aCourse.setEnrolled(rs.getString(13));
                aCourse.setRemainOpen(rs.getString(14));

                courses.add(aCourse);
            }

        }
        catch (Exception ex) {
            ex.printStackTrace();
        }
        finally {
            try {
                if (con != null) { con.close(); }
            }
            catch (Exception ex) {
                ex.printStackTrace();
            }
        }

        return courses;
    }

}
