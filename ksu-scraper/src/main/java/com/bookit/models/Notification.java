package com.bookit.models;

public class Notification {
    private String email;
    private String notificationType;

    public Notification(String email, String notificationType) {
        this.email = email;
        this.notificationType = notificationType;
    }

    public String getEmail() {

        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getNotificationType() {
        return notificationType;
    }

    public void setNotificationType(String notificationType) {
        this.notificationType = notificationType;
    }
}
