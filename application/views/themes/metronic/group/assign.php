<?php
    extract($modeloptions);
    
    $groupAccess = array();
    foreach ($accessgrand as $key => $value) {
        $v = $value->submenu_id.'|'.$value->access_grant;
        array_push($groupAccess, $v);
    }
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
                                Group Role : <?php echo $data['group_name'];?>
                            </h3>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="<?php echo base_url().$route.'/assignsave';?>">                    
                    <input type="hidden" name="groupid" value="<?php echo $groupid;?>"/>
                    <div class="m-portlet__body">
                        <?php 
                        $m = '';
                        foreach ($access as $key => $value) :
                            if ($m == '') { $m = $value->menu_name; echo '<br><div class="m-form__group form-group"><label for="" style="font-weight: 500;border-bottom: 1px solid #bdbec3;font-size:15px;">'.$m.'</label></div>'; } ;?>

                        <?php 
                            if($m != $value->menu_name) {
                                $m = $value->menu_name;
                                echo '<br><div class="m-form__group form-group"><label for="" style="font-weight: 500;border-bottom: 1px solid #bdbec3;font-size:15px;">'.$m.'</label></div>';
                            }
                        ?>
                        <div class="m-form__group form-group">
                            <?php if($value->submenu_name != $value->menu_name):?>
                            <label for="" style="font-weight: 500;"><?php echo $value->submenu_name;?></label>
                            <?php endif;?>
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input type="checkbox" value="1" name="pv[<?php echo $value->id;?>][read]" <?php if (checkExist($groupAccess, $value->id.'|1')) echo 'checked';?>> Read
                                    <span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" value="2" name="pv[<?php echo $value->id;?>][write]" <?php if (checkExist($groupAccess, $value->id.'|2')) echo 'checked';?>> Write
                                    <span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" value="4" name="pv[<?php echo $value->id;?>][delete]" <?php if (checkExist($groupAccess, $value->id.'|4')) echo 'checked';?>> Delete
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <?php endforeach;?>
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