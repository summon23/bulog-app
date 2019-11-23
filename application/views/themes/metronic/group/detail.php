<?php
    extract($modeloptions);
?>
<div class="m-content">
    <?php $this->load->view('themes/'.THEME.'/default/alert');?>
    <div class="row">
        <div class="col-md-8 col-sm-12">

            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab m-portlet--brand m-portlet--head-solid-bg m-portlet--bordered m-portlet--tab">
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
                <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="<?php echo base_url().$route.'/action/edit';?>">
                    <div class="m-portlet__body">
                        <!-- <div class="form-group m-form__group m--margin-top-10">
                            <div class="alert m-alert m-alert--default" role="alert">
                                The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.
                            </div>
                        </div> -->

                        <?php foreach ($modelfield as $key => $value) :
                            $optional = array_key_exists('optional', $value) && $value['optional'] == true?>
                            <?php switch ($value['type']) {
                                case 'hidden': ?>
                                    <input type="hidden" name="<?php echo $key;?>" value="<?php echo $data['id'];?>" <?php if($readonly == true) echo " readonly='true'";?> >
                                <?php break;
                                case 'email':
                                case 'number':
                                case 'text': ?>
                                    <div class="form-group m-form__group">
                                        <label for="input-<?php echo $key;?>"><?php echo $value['fieldname'];?></label>
                                        <input type="<?php echo $value['type'];?>" id="input-<?php echo $key;?>" name="<?php echo $key;?>" class="form-control m-input" value="<?php echo $data[$key];?>" placeholder="Type Here" <?php if($readonly == true) echo " readonly='true'";?> <?php if($optional) : echo ''; else: echo 'required'; endif;?>>
                                        <?php if($optional):?><span class="m-form__help">* Optional</span> <?php endif;?><!-- <span class="m-form__help">We'll never share your email with anyone else.</span> -->
                                    </div>
                                <?php break;
                                case 'password': ?>
                                    <div class="form-group m-form__group">
                                        <label for="input-<?php echo $key;?>"><?php echo $value['fieldname'];?></label>
                                        <input type="password" name="<?php echo $key;?>" id="input-<?php echo $key;?>" class="form-control m-input" value="" placeholder="Type Here" <?php if($readonly == true) echo " readonly='true'";?>>
                                        <?php if($optional):?><span class="m-form__help">* Optional</span> <?php endif;?><!-- <span class="m-form__help">We'll never share your email with anyone else.</span> -->
                                    </div>
                                <?php break;
                                case 'date':?>
                                    <div class="form-group m-form__group">
                                        <label for="m-datepicker-<?php echo $key;?>"><?php echo $value['fieldname'];?></label>
                                        <input type="text" value="<?php echo date('d-m-Y', strtotime($data[$key]));?>" class="form-control" id="m-datepicker-<?php echo $key;?>" name="<?php echo $key;?>"  readonly placeholder="Select date" />
                                    </div>
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#m-datepicker-<?php echo $key;?>').datepicker({
                                                format: 'dd-mm-yyyy',
                                                todayHighlight: true,
                                                autoclose: true
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
                                                defaultTime: '<?php echo $data[$key];?>',
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
                                        <textarea class="form-control m-input" id="input-<?php echo $key;?>" rows="3" name="<?php echo $key;?>" <?php if($optional) : echo ''; else: echo 'required'; endif;?>><?php echo $data[$key];?></textarea>
                                        <?php if($optional):?><span class="m-form__help">* Optional</span> <?php endif;?>
                                    </div>
                                <?php break;
                                case 'dropdown': ?>
                                    <div class="form-group m-form__group">
                                        <label for="input-<?php echo $key;?>"><?php echo $value['fieldname'];?></label>
                                        <select class="form-control m-input" id="input-<?php echo $key;?>" name="<?php echo $key;?>" <?php if($optional) : echo ''; else: echo 'required'; endif;?>>
                                            <option disabled>Please Choose</option>
                                            <?php
                                            $val = $referencevalues[$key];
                                            $source = 'name';
                                            if(array_key_exists('reference', $value)) {
                                                $ref = $value['reference'];
                                                if(array_key_exists('source_key', $ref)) $source = $ref['source_key'];
                                            }
                                            for ($i=0; $i < count($val); $i++) :?>                                                
                                                <option <?php if ($val[$i] == $data[$key]) echo 'selected ';?>value="<?php echo $val[$i]['id'];?>"><?php echo $val[$i][$source];?></option>
                                            <?php endfor;?>
                                        </select>
                                        <?php if($optional):?><span class="m-form__help">* Optional</span> <?php endif;?>
                                    </div>
                                <?php break;
                                case 'file': 
                                    if ($readonly):?>
                                        <div class="form-group m-form__group">
                                            <label><?php echo $value['fieldname'];?></label>
                                            <div class="col-md-12">
                                                <img class="img-responsive" style="max-width:50%" src="<?php echo base_url('documents/').$data[$key];?>"/>
                                            </div>
                                        </div>
                                    <?php else: ?>
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
                                <?php endif;
                                break;
                                default:                                    
                                    break;
                            } ?>
                        <?php endforeach;?>                                    
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <?php if($readonly == true) :?>
                                <a href="<?php echo base_url().$route.'/update/'.$data['id'];?>" class="btn btn-primary">Edit</a>
                            <?php else: ?>
                                <button type="submit" class="btn btn-primary">Save</button>
                            <?php endif;?>
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