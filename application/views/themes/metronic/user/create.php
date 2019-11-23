<?php
    extract($modeloptions);
?>
<div class="m-content">
    <?php $this->load->view('themes/'.THEME.'/default/alert');?>
    <div class="row">
        <div class="col-md-8 col-sm-12">

            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                <?php echo $pagetitle;?>
                            </h3>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="<?php echo base_url().$route.'/action/save';?>">
                    <div class="m-portlet__body">
                        <!-- <div class="form-group m-form__group m--margin-top-10">
                            <div class="alert m-alert m-alert--default" role="alert">
                                The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.
                            </div>
                        </div> -->

                        <?php foreach ($modelfield as $key => $value) :
                            $optional = array_key_exists('optional', $value) && $value['optional'] == true;?>
                            <?php switch ($value['type']) {
                                case 'hidden': ?>
                                    <input type="hidden" name="<?php echo $key;?>">
                                <?php break;
                                case 'password':
                                case 'email':
                                case 'number':
                                case 'text': ?>
                                    <div class="form-group m-form__group">
                                        <label for="input-<?php echo $key;?>"><?php echo $value['fieldname'];?></label>
                                        <input type="<?php echo $value['type'];?>" name="<?php echo $key;?>" class="form-control m-input" id="input-<?php echo $key;?>" placeholder="Type Here" <?php if($optional) : echo ''; else: echo 'required'; endif;?> autocomplete="off">
                                        <?php if($optional):?><span class="m-form__help">* Optional</span> <?php endif;?>
                                    </div>
                                <?php break;
                                case 'date':?>
                                 <div class="form-group m-form__group">
                                     <label for="m-datepicker-<?php echo $key;?>"><?php echo $value['fieldname'];?></label>
                                     <input type="text" class="form-control" id="m-datepicker-<?php echo $key;?>" name="<?php echo $key;?>" readonly placeholder="Select date" />
                                 </div>
                                 <script type="text/javascript">
                                     $(document).ready(function() {
                                         $('#m-datepicker-<?php echo $key;?>').datepicker({
                                             format: 'dd-mm-yyyy',
                                             todayHighlight: true,
                                             autoclose: true, orientation: "bottom"
                                         });
                                     });
                                 </script>
                                <?php break;
                                case 'time':?>
                                    <div class="form-group m-form__group">
                                        <label for="exampleTextarea"><?php echo $value['fieldname'];?></label>
                                        <div class="input-group timepicker">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="la la-clock-o"></i>
                                                </span>
                                            </div>
                                            <input class="form-control m-input" id="m-timepicker-<?php echo $key;?>" name="<?php echo $key;?>" value="" placeholder="Select time" type="text" />
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#m-timepicker-<?php echo $key;?>').timepicker({
                                                // defaultTime: '11:45:20 AM',
                                                minuteStep: 1,
                                                showSeconds: false,
                                                showMeridian: true
                                            });
                                        });
                                    </script>
                                <?php break;
                                case 'textarea': ?>
                                    <div class="form-group m-form__group">
                                        <label for="input-<?php echo $key;?>"><?php echo $value['fieldname'];?></label>
                                        <textarea class="form-control m-input" id="input-<?php echo $key;?>" rows="3" placeholder="Type Here" name="<?php echo $key;?>" <?php if($optional) : echo ''; else: echo 'required'; endif;?>></textarea>
                                        <?php if($optional):?><span class="m-form__help">* Optional</span> <?php endif;?>
                                    </div>
                                <?php break;
                                case 'dropdown': ?>
                                    <div class="form-group m-form__group">
                                        <label for="input-<?php echo $key;?>"><?php echo $value['fieldname'];?></label>
                                        <select class="form-control m-input" id="input-<?php echo $key;?>" name="<?php echo $key;?>" <?php if($optional) : echo ''; else: echo 'required'; endif;?>>
                                            <option disabled selected value="">Please Choose</option>
                                            <?php
                                            $val = $referencevalues[$key];
                                            $source = 'name';
                                            if(array_key_exists('reference', $value)) {
                                                $ref = $value['reference'];
                                                if(array_key_exists('source_key', $ref)) $source = $ref['source_key'];
                                            }
                                            for ($i=0; $i < count($val); $i++) :?>                                                
                                                <option value="<?php echo $val[$i]['id'];?>"><?php echo $val[$i][$source];?></option>
                                            <?php endfor;?>
                                        </select>
                                        <?php if($optional):?><span class="m-form__help">* Optional</span> <?php endif;?>
                                    </div>
                                <?php break;
                                case 'file': ?>
                                    <div class="form-group m-form__group">
                                        <label><?php echo $value['fieldname'];?></label>
                                        <div class="m-dropzone dropzone m-dropzone--primary" id="m-dropzone-<?php echo $key;?>">
                                            <div class="m-dropzone__msg dz-message needsclick">
                                                <h3 class="m-dropzone__msg-title">Drop files here or click to upload.</h3>
                                                <span class="m-dropzone__msg-desc">Upload up to 3 files</span>
                                            </div>
                                            <input type="hidden" name="<?php echo $key;?>" value="" required id="m-input-<?php echo $key;?>">
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        Dropzone.autoDiscover = false;
                                        // or disable for specific dropzone:
                                        // Dropzone.options.myDropzone = false;
                                        $(function() {
                                            // Now that the DOM is fully loaded, create the dropzone, and setup the
                                            // event listeners
                                            var myDropzone = new Dropzone("#m-dropzone-<?php echo $key;?>", {
                                                maxFiles: 1,
                                                url: "<?php echo base_url('core/uploaddocument');?>"
                                            });
                                            myDropzone.on("success", function(res, callback) {
                                                console.log(JSON.parse(callback));
                                                const c = JSON.parse(callback);
                                                $("#m-input-<?php echo $key;?>").val(c.upload_data.file_name);
                                            });
                                        })
                                    </script>
                                <?php break;
                                default:                                    
                                    break;
                            } ?>
                        <?php endforeach;?>

                        <div id="select-store">
                            <div class="form-group m-form__group">
                                <label for="input-store_id">Store</label>
                                <select class="form-control m-input" id="input-store_id" name="store_id">
                                    <option disabled selected value="">Please Choose</option>
                                    <?php
                                    for ($i=0; $i < count($store); $i++) :?>                                                
                                        <option value="<?php echo $store[$i]->id;?>"><?php echo $store[$i]->name;?></option>
                                    <?php endfor;?>
                                </select>
                            </div>                        
                        </div>

                        <br>

                        <div id="select-supplier">
                            <div class="form-group m-form__group">
                                <label for="input-supplier_id">Supplier</label>
                                <select class="form-control m-input" id="input-supplier_id" name="supplier_id">
                                    <option disabled selected value="">Please Choose</option>
                                    <?php
                                    for ($i=0; $i < count($supplier); $i++) :?>                                                
                                        <option value="<?php echo $supplier[$i]->id;?>"><?php echo $supplier[$i]->name;?></option>
                                    <?php endfor;?>
                                </select>
                            </div>                    
                        </div>

                        <div id="select-warehouse">
                            <div class="form-group m-form__group">
                                <label for="input-warehouse_id">Warehouse</label>
                                <select class="form-control m-input" id="input-warehouse_id" name="warehouse_id">
                                    <option disabled selected value="">Please Choose</option>
                                    <?php
                                    for ($i=0; $i < count($warehouse); $i++) :?>                                                
                                        <option value="<?php echo $warehouse[$i]->id;?>"><?php echo $warehouse[$i]->name;?></option>
                                    <?php endfor;?>
                                </select>
                            </div>                    
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" onClick="window.history.back();"class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>

            <!--end::Portlet-->
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#select-supplier').hide();
        $('#select-store').hide();
        $('#select-warehouse').hide();

        $('#input-user_group_id').on('change', function(e) {
            var group = $(this).val();
            if (Number(group) == 5) { // Supplier
                $('#select-supplier').show();
                $('#select-store').hide();
                $('#select-warehouse').hide();
            } else if (Number(group) == 1) { // Sales
                $('#select-supplier').hide();
                $('#select-store').show();
                $('#select-warehouse').hide();
            } else if (Number(group) == 9) { // Warehouse
                $('#select-supplier').hide();
                $('#select-store').hide();
                $('#select-warehouse').show();
            } 
            e.preventDefault();
        });
    });
</script>