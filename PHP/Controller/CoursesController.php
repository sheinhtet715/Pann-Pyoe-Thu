<?php
class CoursesController {
    private $conn;
    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }

    /** @return array<int,array> */
    public function getAllCourses(): array {
        $sql = "SELECT * FROM Course_tbl WHERE is_upcoming = 0 ORDER BY course_name";
        $res = $this->conn->query($sql);
        return $res
            ? $res->fetch_all(MYSQLI_ASSOC)
            : [];
    }
}

class PopularCourse {
    private $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }

    /** @return array<int,array> */
    public function getPopularCourses(): array {
        $sql = "SELECT * FROM Course_tbl WHERE is_popular = 1 ORDER BY course_name";
        $res = $this->conn->query($sql);
        return $res
            ? $res->fetch_all(MYSQLI_ASSOC)
            : [];
    }
}

class UpcomingCourse {
    private $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }

    /** @return array<int,array> */
    public function getUpcomingCourses(): array {
        $sql = "SELECT * FROM Course_tbl WHERE is_upcoming = 1 ORDER BY course_name";
        $res = $this->conn->query($sql);
        return $res
            ? $res->fetch_all(MYSQLI_ASSOC)
            : [];
    }
}
class mostPopularCourse {
    private $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }

    /** @return array<int,array> */
    public function getMostPopularCourses(): array {
        $sql = "SELECT * FROM course_tbl WHERE most_popular = 1 ORDER BY course_name";
        $res = $this->conn->query($sql);
        return $res
            ? $res->fetch_all(MYSQLI_ASSOC)
            : [];
    }
}
?>
