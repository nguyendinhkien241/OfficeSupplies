<?php
    include "./inc/head.php";
    include "./inc/header.php";
    include "./inc/sidebar.php";
?>

<?php
    require('../Carbon/autoload.php');
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
?>

<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php") ;
?>

<?php
    $currentYear = Carbon::now()->year;
    $db = new Database();
    $query = "SELECT DISTINCT YEAR(sta_date) AS year FROM tbl_statistic ORDER BY year DESC";
    $result = $db->select($query);
?>

                    <div class="col l-10 m-12 main-dashboard">
                        <div class="dashboard statistics">
                            <h3 class="discount-heading">Thống kê doanh thu</h3>
                            <div class="main-statistics">
                                <div class="filter-statistics">
                                    <div class="statistic-col">
                                        <label for="sta-year">Năm</label>
                                        <select name="sta-year" id="sta-year">
                                            <option>--- Chọn năm ---</option>
                                            <?php
                                                if($result) {
                                                    while($row = $result->fetch_assoc()) {
                                                        
                                                    
                                            ?>
                                                <option <?php if($row['year'] == $currentYear) echo "selected" ?> value="<?php echo $row['year'] ?>"><?php echo $row['year'] ?></option>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="statistic-col">
                                        <label for="sta-month">Tháng</label>
                                        <select name="sta-month" id="sta-month">
                                            <option>--- Chọn tháng ---</option>
                                            <option value="1">Tháng 1</option>
                                            <option value="2">Tháng 2</option>
                                            <option value="3">Tháng 3</option>
                                            <option value="4">Tháng 4</option>
                                            <option value="5">Tháng 5</option>
                                            <option value="6">Tháng 6</option>
                                            <option value="7">Tháng 7</option>
                                            <option value="8">Tháng 8</option>
                                            <option value="9">Tháng 9</option>
                                            <option value="10">Tháng 10</option>
                                            <option value="11">Tháng 11</option>
                                            <option value="12">Tháng 12</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="myfirstchart" style="height: 250px;"></div>
                            </div>
                        </div>

                        <script>
                            $(document).ready(function() {
                                let selectYear = document.getElementById('sta-year');
                                let selectMonth = document.getElementById('sta-month');
                                filterYear();
                                selectYear.addEventListener('change', function() {
                                    var selectedOption = selectYear.options[selectYear.selectedIndex];
                                    // Kiểm tra nếu giá trị của option không rỗng
                                    if (selectedOption.value !== "") {
                                        // Xóa thuộc tính selected khỏi tất cả các option
                                        for (var i = 0; i < selectYear.options.length; i++) {
                                            selectYear.options[i].removeAttribute('selected');
                                        }

                                        // Gán thuộc tính selected cho option hiện tại
                                        selectedOption.setAttribute('selected', 'selected');
                                        selectMonth.options[0].setAttribute('selected', 'selected');
                                    }
                                    filterYear();
                                });

                                selectMonth.addEventListener('change', function() {
                                    var selectedYearOption = selectYear.options[selectYear.selectedIndex];
                                    var selectedMonthOption = selectMonth.options[selectMonth.selectedIndex];
                                    if (selectedMonthOption.value !== "" && selectedYearOption.value !== "") {
                                        // Xóa thuộc tính selected khỏi tất cả các option
                                        for (var i = 0; i < selectMonth.options.length; i++) {
                                            selectMonth.options[i].removeAttribute('selected');
                                        }

                                        // Gán thuộc tính selected cho option hiện tại
                                        selectedMonthOption.setAttribute('selected', 'selected');
                                    }
                                    filterMonth();
                                })
                                var char = new Morris.Bar({
                                // ID of the element in which to draw the chart.
                                element: 'myfirstchart',
                                // Chart data records -- each entry in this array corresponds to a point on
                                // the chart.
                                data: [],
                                // The name of the data record attribute that contains x-values.
                                xkey: 'date',
                                // A list of names of data record attributes that contain y-values.
                                ykeys: ['revenue', 'amount'],
                                // Labels for the ykeys -- will be displayed when you hover over the
                                // chart.
                                labels: ['Doanh thu', 'Số đơn hàng']
                                });


                                function filterYear() {
                                    var year = selectYear.options[selectYear.selectedIndex].value;
                                    $.ajax({
                                        url: "../ajax/statistic.php",
                                        method: "POST",
                                        dataType: "JSON",
                                        data: {year: year},
                                        cache: false,
                                        success: function(data) {
                                            char.setData(data);
                                        }
                                    });
                                }

                                function filterMonth() {
                                    var year = selectYear.options[selectYear.selectedIndex].value;
                                    var month = selectMonth.options[selectMonth.selectedIndex].value;
                                    $.ajax({
                                        url: "../ajax/statistic.php",
                                        method: "POST",
                                        dataType: "JSON",
                                        data: {year: year, month: month},
                                        cache: false,
                                        success: function(data) {
                                            char.setData(data);
                                        }
                                    });
                                }
                            })

                            
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>