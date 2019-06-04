DELIMITER $$
DROP PROCEDURE IF EXISTS spSelectUserSellBook$$

CREATE PROCEDURE spSelectUserSellBook
(
    IN id integer,
    IN email varchar(255),
    IN bookISBN varchar(255),
    IN bookCondition varchar(255),
    IN minPrice double,
    IN maxPrice double
)
BEGIN
    -- Set optional parameters
    IF email IS NULL || email = "" THEN
        SET email = "%";
    ELSE
        SET email = CONCAT("%", email, "%");
    END IF;
    IF bookISBN IS NULL || bookISBN = "" THEN
        SET bookISBN = "%";
    ELSE
        SET bookISBN = CONCAT("%", bookISBN, "%");
    END IF;
    IF bookCondition IS NULL || bookCondition = "" THEN
        SET bookCondition = NULL;
    ELSE
        SET bookCondition = CONCAT("%", bookCondition, "%");
    END IF;
    IF minPrice IS NULL THEN
        SET minPrice = 0;
    END IF;
    IF maxPrice IS NULL THEN
        SET maxPrice = 9999999;
    END IF;

    SELECT tblUserSellBook.id,
        tblUserSellBook.email,
        tblUserSellBook.bookISBN,
        tblUserSellBook.shortDescription,
        tblUserSellBook.longDescription,
        tblUserSellBook.bookCondition,
        tblUserSellBook.price,
        tblUserSellBook.postDate,
        tblBooks.title
    FROM tblUserSellBook
    LEFT OUTER JOIN tblBooks ON tblBooks.isbn = tblUserSellBook.bookISBN
    WHERE (tblUserSellBook.id = id OR id IS NULL)
        AND tblUserSellBook.email LIKE email
        AND tblUserSellBook.bookISBN LIKE bookISBN
        AND (tblUserSellBook.bookCondition LIKE bookCondition OR bookCondition IS NULL)
        AND tblUserSellBook.price >= minPrice
        AND tblUserSellBook.price <= maxPrice;
END$$
DELIMITER ;
