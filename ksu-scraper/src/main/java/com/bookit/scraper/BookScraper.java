package com.bookit.scraper;

import com.bookit.models.Book;
import com.bookit.models.Course;
import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.openqa.selenium.WebDriver;

import java.util.ArrayList;
import java.sql.Date;
import java.util.List;
import java.util.concurrent.TimeUnit;

public class BookScraper {

    public Document getPage(WebDriver driver, Course course) {

        Document doc = null;

        try {
            String dept = course.getCourse().split("-")[0];
            String number = course.getCourse().split("-")[1];
            String section = course.getCourse().split("-")[2];

            Date springStart = java.sql.Date.valueOf("2019-01-14");
            Date springEnd = java.sql.Date.valueOf("2019-05-05");

            Date summerStart = java.sql.Date.valueOf("2019-06-10");
            Date summerEnd = java.sql.Date.valueOf("2019-08-17");

            Date fallStart = java.sql.Date.valueOf("2019-08-22");
            Date fallEnd = java.sql.Date.valueOf("2019-12-08");

            String term = "";

            if ((course.getStartDate().after(springStart) || course.getStartDate().equals(springStart)) &&
                    (course.getEndDate().before(springEnd)) || course.getEndDate().equals(springEnd)) {
                term = "201910";
            }
            if ((course.getStartDate().after(summerStart) || course.getStartDate().equals(summerStart)) &&
                    (course.getEndDate().before(summerEnd)) || course.getEndDate().equals(summerEnd)) {
                term = "201960";
            }
            if ((course.getStartDate().after(fallStart) || course.getStartDate().equals(fallStart)) &&
                    (course.getEndDate().before(fallEnd)) || course.getEndDate().equals(fallEnd)) {
                term = "201980";
            }

            String url = "https://securex.bncollege.com/webapp/wcs/stores/servlet/TBListView?cm_mmc=RI-_-8152-_-1-_-A&catalogId=10001&storeId=87857&langId=-1& termMapping=Y&courseXml=<?xml version=\"1.0\" encoding=\"UTF-8\"?>" +
                    "<textbookorder><campus name=\"" + course.getCampus() + "\"><courses><course num=\"" + number + "\" dept=\"" + dept +"\" sect=\"" + section + "\" term=\"" + term + "\"/></courses></campus></textbookorder>";

            //String url = "https://securex.bncollege.com/webapp/wcs/stores/servlet/TBListView?cm_mmc=RI-_-8152-_-1-_-A&catalogId=10001&storeId=87857&langId=-1& termMapping=Y&courseXml=<?xml version=\"1.0\" encoding=\"UTF-8\"?><textbookorder><campus name=\"ST\"><courses><course num=\"13001\" dept=\"CS\" sect=\"600\" term=\"201910\"/></courses></campus></textbookorder>";

            System.out.println("Accessing page :: " + url);
            driver.get(url);
            driver.manage().timeouts().implicitlyWait(5, TimeUnit.SECONDS);

            doc = Jsoup.parse(driver.getPageSource());
        }
        catch (Exception ex) {
            ex.printStackTrace();
        }
        finally {
            driver.quit();
        }

        return doc;
    }

    public ArrayList<Book> scrape(Document doc) {
        List<Element> isbn = doc.getElementsByClass("book_c2_180616");
        List<Element> noBook = doc.getElementsByClass("noMaterial_desc");
        ArrayList<Book> books = new ArrayList<Book>();

        if ((isbn.size() == 0) && noBook.size() > 0) {
            System.out.println("No books needed (at this time)");
        }
        else {
            try {
                Book aBook = new Book();
                aBook.setIsbn(isbn.get(0).text().replaceAll("ISBN: ", ""));
                aBook.setTitle(doc.selectFirst("section.mainContent:nth-child(12) div.courseMaterialsList:nth-child(3) div.content section.campusSection:nth-child(16) div.book_sec div.book-list:nth-child(1) div.book_details.clearfix.cm_tb_details.padding_important div.book_desc1.cm_tb_bookInfo:nth-child(3) h1:nth-child(1) > a.clr121").text().replaceAll("TITLE: ", ""));
                aBook.setEditor(doc.selectFirst("section.mainContent:nth-child(12) div.courseMaterialsList:nth-child(3) div.content section.campusSection:nth-child(16) div.book_sec div.book-list div.book_details.clearfix.cm_tb_details.padding_important div.book_desc1.cm_tb_bookInfo:nth-child(3) ul:nth-child(3) > li.book_c1").text().replaceAll("EDITION: ", ""));;
                String author = doc.selectFirst("section.mainContent:nth-child(12) div.courseMaterialsList:nth-child(3) div.content section.campusSection:nth-child(16) div.book_sec div.book-list div.book_details.clearfix.cm_tb_details.padding_important div.book_desc1.cm_tb_bookInfo:nth-child(3) h2:nth-child(2) span:nth-child(3) > i:nth-child(1)").text().replaceAll("AUTHOR: By", "");
                if (author.toCharArray()[0] == 'B' && author.toCharArray()[1] == 'y') {
                    aBook.setAuthor(author.substring(2, author.length()));
                }
                else {
                    aBook.setAuthor(author);
                }
                aBook.setPublisher(doc.selectFirst("section.mainContent:nth-child(12) div.courseMaterialsList:nth-child(3) div.content section.campusSection:nth-child(16) div.book_sec div.book-list div.book_details.clearfix.cm_tb_details.padding_important div.book_desc1.cm_tb_bookInfo:nth-child(3) ul:nth-child(3) > li.book_c2").text().replaceAll("PUBLISHER: ", ""));
                books.add(aBook);
            }
            catch (Exception ex) {
                ex.printStackTrace();
            }

        }

        return books;
    }

}
