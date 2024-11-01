# AsiaYo --- Senior Backend Engineer

## 資料庫測驗

### 題目一

```sql
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
```

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

---

> Database

```
1. Users (用戶)
| 欄位名 | 類型 | 說明 |
| user_id | INT | 主鍵，自增ID |
| username | VARCHAR(50) | 用戶名 |
| password_hash | VARCHAR(255) | 密碼的哈希值 |
| email | VARCHAR(100) | 用戶的電子郵件 |
| created_at | DATETIME | 創建時間 |
| last_login | DATETIME | 最後登入時間 |

2. Messages (訊息)
| 欄位名 | 類型 | 說明 |
| message_id | INT | 主鍵，自增ID |
| sender_id | INT | 外鍵，發送者用戶ID |
| receiver_id | INT | 外鍵，接收者用戶ID |
| group_id | INT | 外鍵，群組ID (可選) |
| content | TEXT | 訊息內容 |
| timestamp | DATETIME | 發送時間 |
| is_read | BOOLEAN | 是否已讀 |

3. Groups (群組)
| 欄位名 | 類型 | 說明 |
| group_id | INT | 主鍵，自增ID |
| group_name | VARCHAR(100) | 群組名稱 |
| created_at | DATETIME | 創建時間 |

4. GroupMembers (群組成員)
| 欄位名 | 類型 | 說明 |
| group_id | INT | 外鍵，群組ID |
| user_id | INT | 外鍵，用戶ID |
| joined_at | DATETIME | 加入時間 |

5. UserStatus (用戶狀態)
| 欄位名 | 類型 | 說明 |
| user_id | INT | 外鍵，用戶ID |
| status | VARCHAR(50) | 用戶狀態 (如：在線、離線) |
| last_active | DATETIME | 最後活動時間 |
```

---

> UML

```
+------------------+
|      User        |
+------------------+
| - user_id: INT   |
| - username: VARCHAR |
| - password_hash: VARCHAR |
| - email: VARCHAR  |
| - created_at: DATETIME |
| - last_login: DATETIME |
+------------------+
| + login()        |
| + logout()       |
| + updateProfile()|
+------------------+
        |
        | 1
        |
        | *
+------------------+
|     Message      |
+------------------+
| - message_id: INT|
| - sender_id: INT |
| - receiver_id: INT|
| - group_id: INT  |
| - content: TEXT  |
| - timestamp: DATETIME |
| - is_read: BOOLEAN |
+------------------+
| + sendMessage()  |
| + markAsRead()   |
+------------------+
        |
        | *
        |
        | 1
+------------------+
|      Group       |
+------------------+
| - group_id: INT  |
| - group_name: VARCHAR |
| - created_at: DATETIME |
+------------------+
| + addMember()    |
| + removeMember() |
+------------------+
        |
        | 1
        |
        | *
+------------------+
|   GroupMember    |
+------------------+
| - group_id: INT  |
| - user_id: INT   |
| - joined_at: DATETIME |
+------------------+
        |
        | 1
        |
        | 1
+------------------+
|   UserStatus     |
+------------------+
| - user_id: INT   |
| - status: VARCHAR |
| - last_active: DATETIME |
+------------------+
```