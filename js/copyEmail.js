function copyEmail(email) {
    var tempField = document.createElement('input');
    tempField.setAttribute("type", "text");
    tempField.setAttribute("display", "none");

    tempField.setAttribute("value", email);
    document.body.appendChild(tempField);
    tempField.select();
    document.execCommand("copy");

    tempField.parentElement.removeChild(tempField);
    alert("Seller Email Copied");
}