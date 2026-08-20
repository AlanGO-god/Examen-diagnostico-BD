<?php
class Sistema {
    private $host = "db"; 
    private $dbname = "employeesdb";
    private $user = "usuario";
    private $password = "password";
    private $pdo;

    public function connection() {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4", $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch(PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function reporte_1() {
        try {
            $db = $this->connection();
            $sql = "SELECT YEAR(hire_date) AS anio_contratacion, gender, COUNT(*) AS total_contratados 
            FROM employees 
            GROUP BY YEAR(hire_date), gender 
            ORDER BY anio_contratacion ASC, gender";
            $stmt = $db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
    }

    public function reporte_2() {
        try {
            $db = $this->connection();
            $sql = "SELECT 
                        d.dept_name AS departamento,
                        ROUND(AVG(s.salary), 2) AS salario_promedio
                    FROM departments d
                    INNER JOIN dept_emp de ON d.dept_no = de.dept_no
                    INNER JOIN salaries s ON de.emp_no = s.emp_no
                    WHERE s.to_date = '9999-01-01' AND de.to_date = '9999-01-01'
                    GROUP BY d.dept_no, d.dept_name
                    ORDER BY salario_promedio DESC";
                        
            $stmt = $db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            die("Error en la consulta del reporte 2: " . $e->getMessage());
        }
    }
    public function reporte_3() {
        try {
            $db = $this->connection();
            $sql = "";
                        
            $stmt = $db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            die("Error en la consulta del reporte 3: " . $e->getMessage());
        }
    }

    public function reporte_4($fecha_corte = '') {
        try {
            $db = $this->connection();

            if (empty($fecha_corte)) {
                $fecha_corte = date('Y-m-d');
            }

            $sql = "";
                        
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':fecha_corte1' => $fecha_corte,
                ':fecha_corte2' => $fecha_corte,
                ':fecha_corte3' => $fecha_corte,
                ':fecha_corte4' => $fecha_corte
            ]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            die("Error en la consulta del reporte 4: " . $e->getMessage());
        }
    }

    public function reporte_5() {
        //echo "Ejecutando reporte_5()...<br>";
        try {
            $db = $this->connection();
            
            $sql = "SELECT 
                        e.emp_no, 
                        CONCAT(e.first_name, ' ', e.last_name) AS empleado,
                        MIN(s.salary) AS salario_minimo,
                        MAX(s.salary) AS salario_maximo,
                        ROUND(((MAX(s.salary) - MIN(s.salary)) / MIN(s.salary)) * 100, 2) AS pct_incremento,
                        TIMESTAMPDIFF(YEAR, MIN(s.from_date), IF(MAX(s.to_date) = '9999-01-01', CURDATE(), MAX(s.to_date))) AS anios_carrera
                    FROM employees e
                    INNER JOIN salaries s ON e.emp_no = s.emp_no
                    GROUP BY e.emp_no, e.first_name, e.last_name
                    HAVING pct_incremento > 0
                    ORDER BY pct_incremento DESC
                    LIMIT 10";
                    
            $stmt = $db->query($sql);
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultados;
        } catch(PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
    }
     public function reporte_6() {
        try {
            $db = $this->connection();
            
            $sql = "SELECT 
                d.dept_name AS departamento,
                t.title AS puesto,
                ROUND(AVG(TIMESTAMPDIFF(MONTH, t.from_date, t.to_date)), 1) AS meses_promedio
            FROM employees e
            INNER JOIN titles t ON e.emp_no = t.emp_no
            INNER JOIN dept_emp de ON e.emp_no = de.emp_no
            INNER JOIN departments d ON de.dept_no = d.dept_no
            WHERE t.to_date < '9999-01-01'
            GROUP BY d.dept_name, t.title
            ORDER BY meses_promedio DESC
            LIMIT 15";
                        
            $stmt = $db->query($sql);
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

           /* echo "Contenido devuelto por MySQL:<br>";
        echo "<pre>";
        print_r($resultados); 
        echo "</pre>";*/

            return $resultados;
        } catch(PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
    }
    public function reporte_7($search) {
        try {
            $db = $this->connection();
            $emp = null;
            $titles = [];
            $departments = [];
            $salaries = [];

            if ($search !== '') {
                $stmt = $db->prepare("SELECT * FROM employees WHERE emp_no = :id OR CONCAT(first_name, ' ', last_name) LIKE :name LIMIT 1");
                $stmt->execute([':id' => $search, ':name' => "%$search%"]);
                $emp = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($emp) {
                    $emp_no = $emp['emp_no'];

                    $tStmt = $db->prepare("SELECT * FROM titles WHERE emp_no = ? ORDER BY from_date DESC");
                    $tStmt->execute([$emp_no]);
                    $titles = $tStmt->fetchAll(PDO::FETCH_ASSOC);

                    $dStmt = $db->prepare("SELECT d.dept_name, de.from_date, de.to_date FROM dept_emp de JOIN departments d ON de.dept_no = d.dept_no WHERE de.emp_no = ? ORDER BY de.from_date DESC");
                    $dStmt->execute([$emp_no]);
                    $departments = $dStmt->fetchAll(PDO::FETCH_ASSOC);

                    $sStmt = $db->prepare("SELECT * FROM salaries WHERE emp_no = ? ORDER BY from_date DESC");
                    $sStmt->execute([$emp_no]);
                    $salaries = $sStmt->fetchAll(PDO::FETCH_ASSOC);
                }
            }

            return [
                'emp' => $emp,
                'titles' => $titles,
                'departments' => $departments,
                'salaries' => $salaries
            ];
        } catch(PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
    }
}
?>