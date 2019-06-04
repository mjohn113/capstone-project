package com.bookit.scraper;

import com.bookit.models.Course;
import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.ui.Select;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import java.util.concurrent.TimeUnit;

public class ClassScraper {

    public Document getPage(WebDriver driver, String url, ArrayList<String> subjectId) {

        System.out.print("Starting scraping URL " + url + " for subject");
        for (String subj : subjectId) {
            System.out.print(" " + subj);
        }
        System.out.println(" ");

        Document doc = null;

        try {
            driver.get(url);
            driver.manage().timeouts().implicitlyWait(3, TimeUnit.SECONDS);

            WebElement selectElement = driver.findElement(By.id("subj_id"));
            Select select = new Select(selectElement);

            for (String subject : subjectId) {
                select.selectByValue(subject);
            }

            selectElement = driver.findElement(By.id("levl_id"));
            select = new Select(selectElement);
            select.selectByValue("UG");

            driver.findElement(By.cssSelector(".standalone input[type=\"submit\"]")).click();

            doc = Jsoup.parse(driver.getPageSource());
        }
        catch (Exception ex) {
            ex.printStackTrace();
        }
        finally {
            try {
                driver.quit();
            } catch (Exception ex) {
                ex.printStackTrace();
            }
        }

        return doc;
    }

    public ArrayList<Course> scrape(Document doc) {
        ArrayList<Course> courses = new ArrayList<Course>();

        List<Element> tables = doc.getElementsByTag("table");

        List<Element> rows = tables.get(3).getElementsByTag("tr");
        rows.remove(0);

        for (Element row: rows) {
            Course aCourse = new Course();
            List<Element> td = row.getElementsByTag("td");

            if (!td.isEmpty()) {
                if (ScraperUtil.tryParseInt(td.get(3).text())) {
                    aCourse.setCrn(td.get(3).text());
                    aCourse.setCourse(td.get(4).text().replaceAll(" - ", "-"));
                    aCourse.setCampus(td.get(5).text());
                    aCourse.setCredits(td.get(6).text());
                    aCourse.setTitle(td.get(7).text());
                    aCourse.setEnrolled(td.get(9).text());
                    aCourse.setRemainOpen(td.get(10).text());

                    int separatorIndex = td.get(12).text().indexOf('-');

                    if (separatorIndex > 0) {
                        try {
                            Date start = new SimpleDateFormat("MM/dd/yy").parse(td.get(12).text().substring(0, separatorIndex));
                            Date end = new SimpleDateFormat("MM/dd/yy").parse(td.get(12).text().substring(separatorIndex+1, td.get(12).text().length()));

                            aCourse.setStartDate(new java.sql.Date(start.getTime()));
                            aCourse.setEndDate(new java.sql.Date(end.getTime()));
                        }
                        catch (Exception ex) {
                            ex.printStackTrace();
                        }
                    }

                    separatorIndex = td.get(14).text().indexOf('-');

                    if (separatorIndex > 0) {
                        try {
                            aCourse.setStartTime(new SimpleDateFormat("hh:mm a").parse(td.get(14).text().substring(0, separatorIndex)));
                            aCourse.setEndTime(new SimpleDateFormat("hh:mm a").parse(td.get(14).text().substring(separatorIndex+1, td.get(14).text().length())));
                        }
                        catch (Exception ex) {
                            ex.printStackTrace();
                        }
                    }

                    aCourse.setMeetDays(td.get(13).text());
                    aCourse.setLocation(td.get(15).text());
                    aCourse.setInstructor(td.get(16).text());

                    courses.add(aCourse);
                }
            }
        }

        return courses;
    }

}
