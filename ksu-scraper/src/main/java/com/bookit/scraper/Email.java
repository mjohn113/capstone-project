package com.bookit.scraper;

import com.bookit.models.User;
import org.simplejavamail.email.EmailBuilder;
import org.simplejavamail.mailer.MailerBuilder;

public class Email {
    private static String host;
    private static String username;
    private static String password;

    public Email(String host, String username, String password) {
        this.host = host;
        this.username = username;
        this.password = password;
    }

    public static void generateAndSendEmail(User user, String subject, String message) throws Exception {
        System.out.println("Sending email to " + user.getEmail());

        org.simplejavamail.email.Email email = EmailBuilder.startingBlank()
                .from(username)
                .to(user.getEmail())
                .withHTMLText(message)
                .withSubject(subject)
                .buildEmail();

        MailerBuilder.withSMTPServer(host, 587 , username, password)
                .buildMailer().sendMail(email);
    }

    public String getHost() {
        return host;
    }

    public void setHost(String host) {
        this.host = host;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }
}
