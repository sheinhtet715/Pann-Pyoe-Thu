<?php
class CounsellorController {
    private $conn;
    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }

    /** @return array<int,array> */
    public function getAllCounsellors(): array {
        $sql = "SELECT * FROM Counsellor_tbl ORDER BY counsellor_name";
        $res = $this->conn->query($sql);
        return $res
            ? $res->fetch_all(MYSQLI_ASSOC)
            : [];
    }
}
