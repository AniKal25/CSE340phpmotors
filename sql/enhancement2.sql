1.

INSERT into clients (clientFirstName, clientLastName, clientEmail, clientPassword, comment) 
 VALUES ('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 'I am the real Ironman');
-- Use "Rollback wheb finished box"

2.

UPDATE clients
SET clientLevel = 3
WHERE clientFirstName = 'tony' AND clientLastName = 'stark';
-- Use "Rollback wheb finished box"

3.

UPDATE inventory
SET invDescription = REPLACE(invDescription,  'small interiors', 'spacious interior') 
WHERE invMake = 'GM' AND invModel = 'Hummer';
-- Use "Rollback wheb finished box"

4.

SELECT i.invModel,  c.classificationName
FROM inventory i
INNER JOIN carclassification c ON i.classificationId = c.classificationId
WHERE c.classificationName = 'SUV';
-- Use "Retain query box"

5.

DELETE FROM inventory
WHERE invMake = 'Jeep' AND invModel = 'Wrangler';
-- Use "Retain query box"

6.

UPDATE inventory
SET invImage = CONCAT('/phpmotors', invImage), invThumbnail = CONCAT('/phpmotors', invThumbnail);
-- Use "Retain query box"




