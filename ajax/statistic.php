<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php") ;
    include_once ($filepath."/../helpers/format.php");
    require('../Carbon/autoload.php');
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
?>

<?php
    $db = new Database();
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    if(isset($_POST['year']) && !isset($_POST['month'])) {
        $year = $_POST['year'];
        $query = "SELECT 
        SUM(sta_revenue) AS revenue, 
        SUM(sta_amount) AS amount, 
        DATE_FORMAT(sta_date, '%Y-%m') AS month
        FROM tbl_statistic
        WHERE YEAR(sta_date) = '$year'
        GROUP BY DATE_FORMAT(sta_date, '%Y-%m')";

        $result = $db->select($query);

        if($result) {
            foreach($result as $key => $row) {
                $char_data[] = array(
                    'date' => $row['month'],
                    'revenue' => $row['revenue'],
                    'amount' => $row['amount']
                );
            }
        }
        echo $data = json_encode($char_data);
    }

    if(isset($_POST['year']) && isset($_POST['month'])) {
        $year = $_POST['year'];
        $month = $_POST['month'];
        $query = "SELECT * FROM tbl_statistic WHERE YEAR(sta_date) = $year AND MONTH(sta_date) = $month ORDER BY sta_date ASC";

        $result = $db->select($query);

        if($result) {
            foreach($result as $key => $row) {
                $char_data[] = array(
                    'date' => $row['sta_date'],
                    'revenue' => $row['sta_revenue'],
                    'amount' => $row['sta_amount']
                );
            }
        }
        echo $data = json_encode($char_data);
    }
?>
