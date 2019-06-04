package com.bookit;

import com.bookit.models.Course;
import com.bookit.models.Notification;
import com.bookit.models.User;
import com.bookit.scraper.Database;
import com.bookit.scraper.ClassScraper;
import com.bookit.scraper.Email;
import com.bookit.scraper.ScraperUtil;
import org.apache.commons.configuration.Configuration;
import org.apache.commons.configuration.PropertiesConfiguration;

import java.util.ArrayList;

public class ClassScraperApplication {
    final private static String urlPrefix = "https://keys.kent.edu/ePROD/bwlkffcs.P_AdvUnsecureCrseSearch?term_in=";

    public static void main(String[] args) throws Exception {
        Configuration props = new PropertiesConfiguration("application.properties");

        Database db = new Database(props.getString("db.url"), props.getString("db.user"), props.getString("db.password"));
        ClassScraper scraper = new ClassScraper();
        ArrayList<String> subjectsToScrape = new ArrayList<String>();

        for (int i = 1; i < args.length; i++) {
            subjectsToScrape.add(args[i]);
        }

        for (Course aCourse: scraper.scrape(scraper.getPage(ScraperUtil.setupDriver(props.getString("webdriver.directory")), urlPrefix + args[0], subjectsToScrape))) {

            try {
                if (db.isInTable(aCourse.getCrn())) {
                    // Retrieve current data in DB
                    Course oldCourse = db.getCourse(aCourse.getCrn());

                    // Perform update operation
                    db.updateInDatabase(aCourse);

                    // If old data doesn't match new
                    if (!(oldCourse.equals(aCourse))) {
                        // If new and old data seatsRemaining aren't the same
                        if ((Integer.parseInt(aCourse.getRemainOpen()) < props.getInt("notification.capacity"))
                                && (!(oldCourse.getRemainOpen().equals(aCourse.getRemainOpen())))) {
                            sendNotificationFor(aCourse, "CAPACITY", db);
                        }

                        // If the old data had seatsRemaining = 0 but new data has seatsRemaining > 0
                        if ((Integer.parseInt(aCourse.getRemainOpen()) > 0)
                                && (Integer.parseInt(oldCourse.getRemainOpen())) == 0) {
                            sendNotificationFor(aCourse, "OPEN", db);
                        }

                        // Instructor changes
                        if (!(aCourse.getInstructor().equals(oldCourse.getInstructor()))) {
                            sendNotificationFor(aCourse, "INSTRUCTOR", db);
                        }

                        // Building changes
                        if (!(aCourse.getLocation().equals(oldCourse.getLocation()))) {
                            sendNotificationFor(aCourse, "BUILDING", db);
                        }

                    }

                }
                else {
                    // It's a new class, simply perform insert
                    db.insertInDatabase(aCourse);
                }
            }
            catch (Exception ex) {
                ex.printStackTrace();
            }

        }

    }

    private static void sendNotificationFor(Course aCourse, String notificationType, Database db) throws Exception {
        Email em = new Email("smtp.gmail.com", "redstonectrl@gmail.com", "g^gPBA5NpA^ejs^zRAFf39zt");

        // Get all users registered to this class
        for (User user: db.getUsersSubscribedTo(aCourse.getCrn())){
            // If this user has notifications set for this notification type
            if (db.userHasNotificationFor(new Notification(user.getEmail(), notificationType))) {
                if (notificationType.equals("CAPACITY")) {
                    String subject = "Course Capacity Alert";
                    String body = aCourse.getTitle() + " has a limited capacity remaining! The current capacity is " +
                            aCourse.getRemainOpen() + ". <a href='http://40.121.205.213/profileNotifications.php'>You can manage your notifications here.</a>";
                    em.generateAndSendEmail(user, subject, body);
                }

                if (notificationType.equals("OPEN")) {
                    String subject = "Open Capacity Alert";
                    String body = aCourse.getTitle() + " was previously full and now has " +
                            aCourse.getRemainOpen() + " seats open. <a href='http://40.121.205.213/profileNotifications.php'>You can manage your notifications here.</a>";
                    em.generateAndSendEmail(user, subject, body);
                }

                if (notificationType.equals("INSTRUCTOR")) {
                    String subject = "Instructor Change Alert";
                    String body = " The instructor for " + aCourse.getTitle() + " has changed! The new instructor is " +
                            aCourse.getInstructor() + ". <a href='http://40.121.205.213/profileNotifications.php'>You can manage your notifications here.</a>";
                    em.generateAndSendEmail(user, subject, body);
                }

                if (notificationType.equals("BUILDING")) {
                    String subject = "Location Change Alert";
                    String body = " The location for " + aCourse.getTitle() + " has changed! The new location is " +
                            aCourse.getLocation() + ". <a href='http://40.121.205.213/profileNotifications.php'>You can manage your notifications here.</a>";
                    em.generateAndSendEmail(user, subject, body);
                }
            }
        }

    }
}
