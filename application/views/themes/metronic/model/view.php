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
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        <?php echo $pagetitle;?>
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="<?php echo base_url().$route;?>/create" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                            <span>
                                <i class="la la-plus"></i>
                                <span>Add <?php echo $pagetitle;?></span>
                            </span>
                        </a>
                    </li>
                    <li class="m-portlet__nav-item"></li>                   
                </ul>
            </div>
        </div>
        <div class="m-portlet__body">

            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                <thead>
                    <th>No</th>
                    <?php foreach ($modelfield as $key => $value) :?>                        
                        <?php if (array_key_exists('columnview', $value) && $value['columnview'] == true) :?>
                            <th><?php echo $value['fieldname'];?></th>
                        <?php endif;?>
                    <?php endforeach;?>
                    <th>Action</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <!-- END EXAMPLE TABLE PORTLET-->
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#m_table_1').DataTable({
            // responsive: true,
            "scrollX": true,
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url : "<?php echo base_url().$route.'/ajaxrequest/get' ?>",
                type : 'GET'
            },
            columnDefs: [
                {
                    searchable: false,
                    orderable: false,
                    targets: 0
                },
                {
					targets: -1,
					title: 'Actions',
					orderable: false,
					render: function(data, type, row, meta){
                        const rowId = row[row.length-1]
                        // console.log(row);
                        // console.log(meta.row().index());
                        return `
                        <?php // Check Priviledge ;?>
                        <a href="<?php echo base_url().$route.'/detail/';?>${rowId}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-eye"></i>
                        </a>
                        <?php // Check Priviledge ;?>
                        <a href="<?php echo base_url().$route.'/update/';?>${rowId}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Update">
                          <i class="la la-edit"></i>
                        </a>
                        <?php // Check Priviledge ;?>
                        <a href="<?php echo base_url().$route.'/delete/';?>${rowId}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">
                          <i style="color:red" class="la la-trash"></i>
                        </a>                    
                        `;
					},
				},
            ]
        });
    });
</script>