<?php if($this->session->flashdata('alert')):?>
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="m-alert m-alert--icon alert alert-<?php echo $this->session->flashdata('alerttype');?>" role="alert">
                <div class="m-alert__icon">
                    <i class="la la-warning"></i>
                </div>
                <div class="m-alert__text">
                    <strong>
                        <?php switch ($this->session->flashdata('alerttype')) {
                            case 'success':
                                echo 'Success';
                                break;
                            case 'warning':
                                echo 'Warning';
                                break;
                            default:
                                # code...
                                break;
                        }?>
                    </strong> <?php echo $this->session->flashdata('alertmessage');?>
                </div>
                <div class="m-alert__close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin:18px;">
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>