<div class="mobile_no_container">
    <div class="col-lg-10 mobile_no_fields">
        <?= $form->field($model, 'mobile_no[]')->textInput(['maxlength' => true, 'value' => @$j]) ?>        
    </div>
    <div class="col-lg-2">
        <br />
        <?php if(isset($k) AND $k ==0 ){ ?>
            <div class="btn btn-primary" id="mobile_plus_button">+</div >
        <?php }else{ ?>
            <div class="btn btn-danger mobile_delete_button" >-</div>
        <?php } ?>
    </div>
</div>