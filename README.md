```sql
# AsiaYo - Senior Backend Engineer

## 資料庫測驗

### 題目一

SELECT 
    t1.*
FROM (
    SELECT
        orders.bnb_id,
        bnbs.name,
        orders.currency,
        SUM(orders.amount) AS may_amount
    FROM orders
    LEFT JOIN
        bnbs ON orders.bnb_id = bnbs.id
    WHERE 
        orders.created_at >= '2023-05-01 00:00:00' AND
        orders.created_at < '2023-05-02 00:00:00' AND
        orders.currency = 'TWD'
    GROUP BY
        orders.bnb_id, bnbs.name, orders.currency
    ORDER BY
        may_amount DESC
    LIMIT 10
) AS t1
UNION ALL
SELECT 
    t2.*
FROM (
    SELECT
        orders.bnb_id,
        bnbs.name,
        orders.currency,
        SUM(orders.amount) AS may_amount
    FROM orders
    LEFT JOIN
        bnbs ON orders.bnb_id = bnbs.id
    WHERE
        orders.created_at >= '2023-05-01 00:00:00' AND
        orders.created_at < '2023-05-02 00:00:00' AND
    GROUP BY
        orders.bnb_id, bnbs.name, orders.currency
) AS t2;

### 題目二

1. 分析SQL條件，where、join、group by、基數，增加索引
- bnb_id
- (created_at, currency)

2. 可以使用排程，製作日訂單統計報表與月訂單統計報表。
再依題目一需求，查詢月訂單統計報表

3. 若不使用2的方法，也可製作VIEW表 or 統計報表，在新增、刪除、修改時，做即時運算。
再依題目一需求，查詢VIEW表 or 統計報表

## API 實作測驗

### 題目一

- [S] 每一種幣別皆有各自的Model, 單一職責

- [L] 由於幣別訂單的格式一樣, 所以建立共通的 App\Orders, 增加可維護性, 也易於擴展

## 架構測驗

### 題目一

參考時下熱門的線上通訊軟體，來擬定要開發的功能，例如: 文字&圖片&影音傳輸, 網路通話, etc..

可能需要的軟體技術，系統架構設計，可能會遇到的困難，該如何克服，

需求確定完成，進行資料庫設計，程式設計&開發，測試

```