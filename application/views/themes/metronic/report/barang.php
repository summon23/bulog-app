<div class="m-content">
    <?php $this->load->view('themes/'.THEME.'/default/alert');?>
    <!-- <div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
        <div class="m-alert__icon">
            <i class="flaticon-exclamation m--font-brand"></i>
        </div>
        <div class="m-alert__text">
            DataTables is a plug-in for the jQuery Javascript library. It is a highly flexible tool, based upon the foundations of progressive enhancement, and will add advanced interaction controls to any HTML table.
            For more info see <a href="https://datatables.net/" target="_blank">the official home</a> of the plugin.
        </div>
    </div> -->
    <div class="row">
        <div class="col-lg-6"> <!-- Report Sales Order -->
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Report Modules
                            </h3>
                        </div>
                    </div>
                </div>
                <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="<?php echo base_url('report/generateBarang');?>">
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group">
                            <label for="m-datepicker-startdate">Start Date</label>
                            <input type="text" class="form-control" id="m-datepicker-startdate" name="startdate" readonly placeholder="Select date" />
                        </div>

                        <div class="form-group m-form__group">
                            <label for="m-datepicker-enddate">End Date</label>
                            <input type="text" class="form-control" id="m-datepicker-enddate" name="enddate" readonly placeholder="Select date" />
                        </div>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('#m-datepicker-startdate').datepicker({
                                    format: 'dd-mm-yyyy',
                                    todayHighlight: true,
                                    autoclose: true, orientation: "bottom"
                                });

                                $('#m-datepicker-enddate').datepicker({
                                    format: 'dd-mm-yyyy',
                                    todayHighlight: true,
                                    autoclose: true, orientation: "bottom"
                                });
                            });
                        </script>                                        
                    </div>

                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" onClick="window.history.back();"class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- END EXAMPLE TABLE PORTLET-->
</div>


<script type="text/javascript">
</script>