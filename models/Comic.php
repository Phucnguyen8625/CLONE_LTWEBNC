<?php
class Comic {
    private $conn;
    private $table_name = "comics";

    public $id;
    public $category_id;
    public $category_name; // To store joined data
    public $name;
    public $author;
    public $price;
    public $quantity;
    public $image_url;
    public $description;
    public $is_sale;
    public $is_combo;
    public $is_bestseller;
    public $is_preorder;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy toàn bộ truyện kèm theo tên danh mục
    public function readAll() {
        $query = "SELECT c.*, cat.name as category_name 
                  FROM " . $this->table_name . " c 
                  LEFT JOIN categories cat ON c.category_id = cat.id 
                  ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Lấy chi tiết 1 truyện theo ID
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->category_id = $row['category_id'];
            $this->name = $row['name'];
            $this->author = $row['author'];
            $this->price = $row['price'];
            $this->quantity = $row['quantity'];
            $this->image_url = $row['image_url'];
            $this->description = $row['description'];
            $this->is_sale = $row['is_sale'];
            $this->is_combo = $row['is_combo'];
            $this->is_bestseller = $row['is_bestseller'];
            $this->is_preorder = $row['is_preorder'];
            return true;
        }
        return false;
    }

    // Thêm truyện mới
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET category_id=:category_id, name=:name, author=:author, 
                      price=:price, quantity=:quantity, image_url=:image_url, description=:description,
                      is_sale=:is_sale, is_combo=:is_combo, is_bestseller=:is_bestseller, is_preorder=:is_preorder";
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->image_url = htmlspecialchars(strip_tags($this->image_url));
        $this->description = htmlspecialchars(strip_tags($this->description));

        // Bind
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":image_url", $this->image_url);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":is_sale", $this->is_sale);
        $stmt->bindParam(":is_combo", $this->is_combo);
        $stmt->bindParam(":is_bestseller", $this->is_bestseller);
        $stmt->bindParam(":is_preorder", $this->is_preorder);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Cập nhật truyện
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET category_id=:category_id, name=:name, author=:author, 
                      price=:price, quantity=:quantity, image_url=:image_url, description=:description,
                      is_sale=:is_sale, is_combo=:is_combo, is_bestseller=:is_bestseller, is_preorder=:is_preorder
                  WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->image_url = htmlspecialchars(strip_tags($this->image_url));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":image_url", $this->image_url);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":is_sale", $this->is_sale);
        $stmt->bindParam(":is_combo", $this->is_combo);
        $stmt->bindParam(":is_bestseller", $this->is_bestseller);
        $stmt->bindParam(":is_preorder", $this->is_preorder);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Xóa truyện
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Tìm kiếm truyện theo từ khóa (tên hoặc tác giả)
    public function search($keyword) {
        $keyword = '%' . $keyword . '%';
        $query = "SELECT c.*, cat.name as category_name
                  FROM " . $this->table_name . " c
                  LEFT JOIN categories cat ON c.category_id = cat.id
                  WHERE c.name LIKE :kw OR c.author LIKE :kw OR c.description LIKE :kw
                  ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':kw', $keyword);
        $stmt->execute();
        return $stmt;
    }

    // Lấy truyện theo danh mục
    public function readByCategory($category_id) {
        $query = "SELECT c.*, cat.name as category_name
                  FROM " . $this->table_name . " c
                  LEFT JOIN categories cat ON c.category_id = cat.id
                  WHERE c.category_id = :cat_id
                  ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':cat_id', $category_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    // Lấy truyện theo cờ đặc biệt (is_sale, is_combo, is_bestseller, is_preorder)
    public function readByFlag($flagName) {
        $allowedFlags = ['is_sale', 'is_combo', 'is_bestseller', 'is_preorder'];
        if (!in_array($flagName, $allowedFlags)) return null;

        $query = "SELECT c.*, cat.name as category_name
                  FROM " . $this->table_name . " c
                  LEFT JOIN categories cat ON c.category_id = cat.id
                  WHERE c." . $flagName . " = 1
                  ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Lấy truyện giá rẻ (giá thấp nhất lên đầu)
    public function readCheap($limit = 5) {
        $query = "SELECT c.*, cat.name as category_name
                  FROM " . $this->table_name . " c
                  LEFT JOIN categories cat ON c.category_id = cat.id
                  ORDER BY c.price ASC
                  LIMIT :limit";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }
}
?>
