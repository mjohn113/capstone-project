package com.bookit;

import com.bookit.models.Book;
import com.bookit.models.Course;
import com.bookit.scraper.BookScraper;
import com.bookit.scraper.Database;
import com.bookit.scraper.ScraperUtil;
import org.apache.commons.configuration.Configuration;
import org.apache.commons.configuration.PropertiesConfiguration;
import org.openqa.selenium.WebDriver;

import java.util.ArrayList;
import java.util.concurrent.TimeUnit;

public class BookScraperApplication {

    public static void main(String[] args) throws Exception {
        Configuration props = new PropertiesConfiguration("application.properties");
        Database db = new Database(props.getString("db.url"), props.getString("db.user"), props.getString("db.password"));

        BookScraper bs = new BookScraper();

        for (Course aCourse : db.getClassesWithoutBooks()) {
            System.out.println("Getting book for " + aCourse.getCourse() + " :: " + aCourse.getCrn());

            ArrayList<Book> books = bs.scrape(bs.getPage(ScraperUtil.setupDriver(props.getString("webdriver.directory")),aCourse));

            for (Book aBook: books) {
                if (db.isInTable(aBook)) {
                    db.insertBookInRequiredTbl(aCourse, aBook);
                }
                else {
                    db.insertBookInDatabase(aCourse, aBook);
                }
            }

            System.out.println("Sleeping for 30 seconds");
            TimeUnit.SECONDS.sleep(30);

        }

    }

}
