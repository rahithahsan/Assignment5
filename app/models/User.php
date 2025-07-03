<?php
/**
 * User model  – handles registration, login, lock-out + audit log
 */
class User
{
    private PDO $db;

    public function __construct()
    {
        $this->db = db_connect();                      // PDO singleton
    }

    /* ──────- password policy (kept STATIC so we can call User::passwordMeetsPolicy) */
    public static function passwordMeetsPolicy(string $p): bool
    {
        return strlen($p) >= 8               // ≥ 8 chars
            && preg_match('/[A-Z]/', $p)     // upper
            && preg_match('/[a-z]/', $p)     // lower
            && preg_match('/\d/', $p)        // digit
            && preg_match('/[^A-Za-z0-9]/', $p); // special
    }
    /* ────────── Registration ────────── */
    public function register(string $u, string $p, int $adminFlag = 0): void
    {
        $sql = "INSERT INTO users (username, password_hash, is_admin)
                VALUES (?, ?, ?)";
        $this->db->prepare($sql)->execute([
            strtolower($u),
            password_hash($p, PASSWORD_DEFAULT),
            $adminFlag
        ]);
    }

    /* ────────── Authentication ────────── */
    /** @return int|null  user’s PK on success, null otherwise */
    public function authenticate(string $u, string $p): ?int
    {
        $stmt = $this->db->prepare(
            "SELECT id, password_hash, is_admin
               FROM users
              WHERE username = ?"
        );
        $stmt->execute([strtolower($u)]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $ok = $row && password_verify($p, $row['password_hash']);
        $this->logAttempt($u, $ok ? 'good' : 'bad');

        if ($ok) {
            /* store extras for the session */
            $_SESSION['uid']      = (int)$row['id'];
            $_SESSION['is_admin'] = (bool)$row['is_admin'];
            return (int)$row['id'];
        }
        return null;
    }

    /* ────────── 3 bad attempts → 60 s lock-out ────────── */
    public function lockedOut(string $u): bool
    {
        $q = "SELECT outcome, created_at
                FROM log
               WHERE username = ?
            ORDER BY id DESC
               LIMIT 3";
        $stmt = $this->db->prepare($q);
        $stmt->execute([strtolower($u)]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) < 3) return false;

        $allBad   = array_reduce($rows, fn($c,$r)=>$c && $r['outcome']==='bad', true);
        $within60 = time() - strtotime($rows[0]['created_at']) < 60;

        return $allBad && $within60;
    }

    /* ────────── helpers ────────── */
    private function logAttempt(string $u, string $out): void
    {
        $this->db
            ->prepare("INSERT INTO log(username, outcome) VALUES (?, ?)")
            ->execute([strtolower($u), $out]);
    }
    public function loginCounts(): array
    {
        $sql = "SELECT username, COUNT(*) AS cnt
                  FROM log
                 WHERE outcome = 'good'
              GROUP BY username
              ORDER BY cnt DESC";
        $rows = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return array_column($rows, 'cnt', 'username');
    }
}
