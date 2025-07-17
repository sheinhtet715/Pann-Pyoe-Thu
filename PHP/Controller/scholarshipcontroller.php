<?php
// ScholarshipController.php
class ScholarshipController {
    protected $conn;
    protected $userId;

    public function __construct(mysqli $dbConnection, ?int $userId) {
        $this->conn   = $dbConnection;
        $this->userId = $userId ?: 0;
    }

    public function getAllScholarships(): array {
        $sql = "
          SELECT
            s.scholarship_id,
            s.title,
            s.description,
            s.coverage,
            s.apply_link,
            s.deadline,
            s.intake_season,
            s.degree_level,
            s.type,
            s.eligibility,
            s.country,
            s.logo_url,
            CASE WHEN f.scholarship_id IS NOT NULL THEN 1 ELSE 0 END AS is_fav
          FROM Scholarship_tbl s
          LEFT JOIN FavouriteScholarship_tbl f
            ON s.scholarship_id = f.scholarship_id
           AND f.user_id = ?
          ORDER BY s.intake_season, s.title
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $this->userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $scholarships = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $scholarships;
    }
}
