-- Write a query to get Product name and quantity/unit
SELECT ProductName, QuantityPerUnit FROM products;


-- Write a query to get current Product list (Product ID and name).
SELECT ProductID, ProductName FROM products;


-- Write a query to get most expense and least expensive Product list (name and unitprice).
SELECT ProductName, UnitPrice FROM products WHERE UnitPrice = (SELECT MAX(UnitPrice) FROM products);
SELECT ProductName, UnitPrice FROM products WHERE UnitPrice = (SELECT MIN(UnitPrice) FROM products);


-- Write a query to get Product list (name, unit price) of above average price.
SELECT ProductName, UnitPrice FROM products WHERE UnitPrice > (SELECT AVG(UnitPrice) FROM products);


-- Write a query to get Product list (id, name, unit price) where current products costless than $20
SELECT ProductID, ProductName, UnitPrice FROM products WHERE UnitPrice < 20;


-- Write a query to get Product list (name, units on order , units in stock) of stock is lessthan the quantity on order.
SELECT ProductName, UnitsInOrder, UnitsInStock FROM products where UnitsInStock < UnitsInOrder;