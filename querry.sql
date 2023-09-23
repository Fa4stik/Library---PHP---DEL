-- 1
SELECT name, author
FROM books
WHERE author IN ('Лев Толстой', 'СКБ Контур')
ORDER BY author DESC, name ASC;

-- 2
SELECT surname
FROM clients
WHERE surname LIKE '%ов';

-- 3
SELECT DISTINCT book_id
FROM issuanceOfBooks;

-- 4
SELECT client_id, COUNT(*) as total_issues
FROM issuanceOfBooks
GROUP BY client_id;

-- 5
SELECT id, name
FROM books
WHERE id NOT IN (SELECT DISTINCT book_id FROM issuanceOfBooks);

-- 6
SELECT client_id
FROM issuanceOfBooks
GROUP BY client_id
HAVING COUNT(*) > 5;

-- 7
SELECT c.id, c.surname, IFNULL(COUNT(i.id), 0) as number_of_issues
FROM clients c
INNER JOIN issuanceOfBooks i ON c.id = i.client_id
WHERE c.id = 1
GROUP BY c.id;

-- 8
SELECT book_id, COUNT(*) as number_of_issues, AVG(DATEDIFF(endDate, startDate)) as average_duration
FROM issuanceOfBooks
GROUP BY book_id;

-- 9
SELECT b.name as book_name, COUNT(*) as count_issued
FROM issuanceOfBooks i
INNER JOIN books b ON i.book_id = b.id
GROUP BY client_id, book_id
HAVING count_issued > 1;

-- 10
SELECT book_id, COUNT(*) as count_issued
FROM issuanceOfBooks
WHERE DATEDIFF(endDate, startDate) >= 30
GROUP BY book_id
HAVING count_issued > 10;