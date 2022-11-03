<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-05-26 12:10:20 --> Severity: error --> Exception: Unable to generate image: check your GD installation /Users/saleem/Sites/sma/vendor/endroid/qr-code/src/Writer/PngWriter.php 74
ERROR - 2021-05-26 12:10:39 --> Severity: error --> Exception: Unable to generate image: check your GD installation /Users/saleem/Sites/sma/vendor/endroid/qr-code/src/Writer/PngWriter.php 74
ERROR - 2021-05-26 12:10:45 --> Severity: error --> Exception: Unable to generate image: check your GD installation /Users/saleem/Sites/sma/vendor/endroid/qr-code/src/Writer/PngWriter.php 74
ERROR - 2021-05-26 12:31:38 --> Could not find the language line "due_date"
ERROR - 2021-05-26 12:31:38 --> Severity: error --> Exception: Unable to generate image: check your GD installation /Users/saleem/Sites/sma/vendor/endroid/qr-code/src/Writer/PngWriter.php 74
ERROR - 2021-05-26 12:33:32 --> Severity: Warning --> foreach() argument must be of type array|object, bool given /Users/saleem/Sites/sma/themes/default/admin/views/pos/view.php 156
ERROR - 2021-05-26 12:33:32 --> Severity: error --> Exception: Unable to generate image: check your GD installation /Users/saleem/Sites/sma/vendor/endroid/qr-code/src/Writer/PngWriter.php 74
ERROR - 2021-05-26 12:33:43 --> Severity: Warning --> foreach() argument must be of type array|object, bool given /Users/saleem/Sites/sma/themes/default/admin/views/pos/view.php 156
ERROR - 2021-05-26 12:33:43 --> Severity: error --> Exception: Unable to generate image: check your GD installation /Users/saleem/Sites/sma/vendor/endroid/qr-code/src/Writer/PngWriter.php 74
ERROR - 2021-05-26 13:18:46 --> Query error: Table 'sma.sma_product' doesn't exist - Invalid query: SELECT SUM(by_price) as stock_by_price, SUM(by_cost) as stock_by_cost FROM ( Select sum(COALESCE(sma_warehouses_products.quantity, 0))*price as by_price, sum(COALESCE(sma_warehouses_products.quantity, 0))*cost as by_cost FROM sma_product JOIN sma_warehouses_products ON sma_warehouses_products.product_id=sma_products.id WHERE sma_warehouses_products.warehouse_id = '2' GROUP BY sma_products.id )a
