# BASE
SELECT
 t1.idProduct,
 t1.nameProduct,
 t1.quantity,
 t2.stock AS 'stockOfProductInventary',
 t5.stock AS 'stockOfProductOutInventary',
 t3.backUpStock AS 'stockBackUpByProvider',
 t3.idProvider,
 t4.name
FROM
     relOrdersProducts AS t1
        LEFT JOIN products AS t2 ON (t1.idProduct = t2.id)
        LEFT JOIN relProviderProducts AS t3 ON (t2.id = t3.idProduct)
        LEFT JOIN providers AS t4 ON (t3.idProvider = t4.id)
        LEFT JOIN productsOutOfInventory t5 ON (t1.id = t5.id);


# REPORTE C
SELECT
    t1.idProduct,
    t1.nameProduct,
    t2.stock AS 'stockOfProductFromInventary'
FROM
    relOrdersProducts AS t1
        LEFT JOIN products AS t2 ON (t1.idProduct = t2.id);


# REPORTE D
SELECT
    t1.idProduct,
    GROUP_CONCAT(t1.nameProduct) AS nameProduct,
    SUM(t1.quantity) AS quantitySold,
    t2.stock AS stockInventary,
    IF(SUM(t1.quantity) > t2.stock, 'YES', 'NOT') AS SupplyByProvider
FROM
    orders AS t0
        INNER  JOIN relOrdersProducts AS t1 ON (t0.id = t1.idOrder)
        INNER JOIN products AS t2 ON (t1.idProduct = t2.id)
GROUP BY t1.idProduct ORDER BY t1.idProduct;


# REPORTE E
SELECT
    t1.idProduct,
    GROUP_CONCAT(t1.nameProduct) AS nameProduct,
    (IF((t2.stock - SUM(t1.quantity)) <= 0, 0,  t2.stock - SUM(t1.quantity))) AS UnitsAvailable
FROM
    orders AS t0
        INNER  JOIN relOrdersProducts AS t1 ON (t0.id = t1.idOrder)
        INNER JOIN products AS t2 ON (t1.idProduct = t2.id)
WHERE t0.deliveryDate = '2019-03-01'
GROUP BY t1.idProduct ORDER BY t1.idProduct