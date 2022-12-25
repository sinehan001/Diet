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
                   

                  

                    <div class="panel-heading">
                         <?php echo lang('hospital').' '. lang('expense_vs_income'); ?> 
                        
                        <div class="col-md-1 pull-right no-print">
                            <a class="no-print pull-right" onclick="javascript:window.print();"> <i class="fa fa-print"></i>  </a>
                        </div>
                        
                    </div>
                    <div  id="chart_div"></div>




                    <div class="panel-body">
                        <div class="adv-table editable-table ">

                            <div class="space15"></div>
                            <section class="panel-body">
                             
                            <table class="table table-striped table-hover table-bordered" id="editable-sample1">
                                <thead>
                                <tr>
                                   <th colspan="2"><?php echo lang('total').' '.lang('bill');?>:</th>
                                 </tr>
                                </thead>
                                <tbody>
                                <tr>
                                        <td> <?php echo lang('income'); ?> </td>
                                        <td> <?php echo $this->currency; ?><?php echo number_format($total_income, 2, '.', ','); ?> </td>
                                        
                                       
                                    </tr>
                                  <tr>
                                     <td> <?php echo lang('expense'); ?> </td>
                                      <td><?php echo $this->currency; ?><?php echo number_format($total_expense, 2, '.', ','); ?></td>
                                  </tr>

                                    
                                     

                                        <tr class="total_amount">
                                        <td><?php echo lang('net_profit'); ?></td> 
                                        <td><?php echo $this->currency; ?><?php echo number_format(($total_income-$total_expense), 2, '.', ','); ?></td>
                                    </tr>


                                                   

                                </tbody>
                            </table>
                                </section>
                                <section class="panel-body">
                             
                            <table class="table table-striped table-hover table-bordered" id="editable-sample1">
                                <thead>
                                <tr>
                                   <th colspan="2"><?php echo lang('this_month').' '.lang('bill') ;?>:</th>
                                 </tr>
                                </thead>
                                <tbody>
                                <tr>
                                        <td> <?php echo lang('income'); ?> </td>
                                        <td> <?php echo $this->currency; ?><?php echo number_format($this_month_total_income, 2, '.', ','); ?> </td>
                                        
                                       
                                    </tr>
                                  <tr>
                                     <td> <?php echo lang('expense'); ?> </td>
                                      <td><?php echo $this->currency; ?><?php echo number_format($this_month_total_expense, 2, '.', ','); ?></td>
                                  </tr>

                                    
                                     

                                        <tr class="total_amount">
                                        <td><?php echo lang('net_profit'); ?></td> 
                                        <td><?php echo $this->currency; ?><?php echo number_format(($this_month_total_income-$this_month_total_expense), 2, '.', ','); ?></td>
                                    </tr>


                                                   

                                </tbody>
                            </table>
                                </section>
                                <section class="panel-body">
                             
                             <table class="table table-striped table-hover table-bordered" id="editable-sample1">
                                 <thead>
                                 <tr>
                                    <th colspan="2"><?php echo lang('this_week').' '.lang('bill') ;?>:</th>
                                  </tr>
                                 </thead>
                                 <tbody>
                                 <tr>
                                         <td> <?php echo lang('income'); ?> </td>
                                         <td> <?php echo $this->currency; ?><?php echo number_format($this_week_total_income, 2, '.', ','); ?> </td>
                                         
                                        
                                     </tr>
                                   <tr>
                                      <td> <?php echo lang('expense'); ?> </td>
                                       <td><?php echo $this->currency; ?><?php echo number_format($this_week_total_expense, 2, '.', ','); ?></td>
                                   </tr>
 
                                     
                                      
 
                                         <tr class="total_amount">
                                         <td><?php echo lang('net_profit'); ?></td> 
                                         <td><?php echo $this->currency; ?><?php echo number_format(($this_week_total_income-$this_week_total_expense), 2, '.', ','); ?></td>
                                     </tr>
 
 
                                                    
 
                                 </tbody>
                             </table>
                                 </section>
                                 <section class="panel-body">
                             
                             <table class="table table-striped table-hover table-bordered" id="editable-sample1">
                                 <thead>
                                 <tr>
                                    <th colspan="2"><?php echo lang('last_30_days').' '.lang('bill') ;?>:</th>
                                  </tr>
                                 </thead>
                                 <tbody>
                                 <tr>
                                         <td> <?php echo lang('income'); ?> </td>
                                         <td> <?php echo $this->currency; ?><?php echo number_format($this_last_30_total_income, 2, '.', ','); ?> </td>
                                         
                                        
                                     </tr>
                                   <tr>
                                      <td> <?php echo lang('expense'); ?> </td>
                                       <td><?php echo $this->currency; ?><?php echo number_format($this_last_30_total_expense, 2, '.', ','); ?></td>
                                   </tr>
 
                                     
                                      
 
                                         <tr class="total_amount">
                                         <td><?php echo lang('net_profit'); ?></td> 
                                         <td><?php echo $this->currency; ?><?php echo number_format(($this_last_30_total_income-$this_last_30_total_expense), 2, '.', ','); ?></td>
                                     </tr>
 
 
                                                    
 
                                 </tbody>
                             </table>
                                 </section>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--state overview end-->
    </section>
</section>
<!--main content end-->

</section>

<!-- js placed at the end of the document so the pages load faster -->

<script src="common/js/codearistos.min.js"></script>

</body>
</html>
