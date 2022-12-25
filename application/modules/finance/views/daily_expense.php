<!--sidebar end-->
<!--main content start-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<section id="main-content"> 
    <section class="wrapper site-min-height">
        <!--state overview start-->
         <link href="common/extranal/css/finance/daily.css" rel="stylesheet">
        <div class="col-md-12">
            <div class="row state-overview state_overview_design">
                <div class="col-md-8">
                    <!--custom chart start-->

                    <?php
                    $currently_processing_month = date('m', $first_minute);
                    $currently_processing_year = date('Y', $first_minute);
                    if ($currently_processing_month < 12) {
                        $next_month = $currently_processing_month + 1;
                        $next_year = $currently_processing_year;
                    } else {
                        $next_month = 1;
                        $next_year = $currently_processing_year + 1;
                    }

                    if ($currently_processing_month > 1) {
                        $previous_month = $currently_processing_month - 1;
                        $previous_year = $currently_processing_year;
                    } else {
                        $previous_month = 12;
                        $previous_year = $currently_processing_year - 1;
                    }
                    ?>

                    <div class="panel-heading"> <?php echo date('F, Y', $first_minute) . ' ' . lang('hospital').' '.lang('expense_report'); ?> 

                        <div class="col-md-1 pull-right no-print">
                            <a class="no-print pull-right" onclick="javascript:window.print();"> <i class="fa fa-print"></i>  </a>
                        </div>
                        <div class="col-md-1 pull-right no-print">
                            <a href="finance/dailyExpense?year=<?php echo $next_year; ?>&month=<?php echo $next_month; ?>">
                                <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                        <div class="col-md-1 pull-right no-print">
                            <a href="finance/dailyExpense?year=<?php echo $previous_year; ?>&month=<?php echo $previous_month; ?>">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                    <div  id="chart_div"></div>




                    <div class="panel-body">
                        <div class="adv-table editable-table ">

                            <div class="space15"></div>
                            <table class="table table-striped table-hover table-bordered" id="editable-sample1">
                                <thead>
                                    <tr>
                                        <th> <?php echo lang('date'); ?> </th>
                                        <th> <?php echo lang('amount'); ?> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $number_of_days = date('t', $first_minute);
                                    for ($d = 1; $d <= $number_of_days; $d++) {
                                        $time = mktime(12, 0, 0, $month, $d, $year);
                                        if (!empty($all_expenses[date('D d-m-y', $time)])) {
                                            if (date('m', $time) == $month) {
                                                $day = date('D d-m-y', $time);
                                                $amount = $all_expenses[date('D d-m-y', $time)];
                                            }
                                        } else {
                                            if (date('m', $time) == $month) {
                                                $day = date('D d-m-y', $time);
                                                $amount = 0;
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $day; ?></td>
                                            <td><?php echo $this->currency; ?><?php echo number_format($amount, 2, '.', ','); ?></td>
                                            <?php $total_amount[] = $amount; ?>
                                        </tr>

                                        <?php
                                    }
                                    ?>

                                    <?php
                                    if (!empty($total_amount)) {
                                        $total_amount = array_sum($total_amount);
                                    } else {
                                        $total_amount = 0;
                                    }
                                    ?>

                                        <tr class="total_amount">
                                        <td><?php echo lang('total'); ?></td> 
                                        <td><?php echo $this->currency; ?><?php echo number_format($total_amount, 2, '.', ','); ?></td>
                                    </tr>
                

                                </tbody>
                            </table>
                        </div>
                    </div>









                </div>
            </div>
        </div>
        <!--state overview end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
<!--footer end-->

</section>

<!-- js placed at the end of the document so the pages load faster -->

<script src="common/js/codearistos.min.js"></script>



</body>
</html>
