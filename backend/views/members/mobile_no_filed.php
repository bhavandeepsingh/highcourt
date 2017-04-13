<div class="mobile_no_container">
    <div class="col-lg-10 mobile_no_fields">
        <?= $form->field($model, 'mobile_no[]')->textInput(['maxlength' => true, 'value' => @$j]) ?>        
    </div>
    <div class="col-lg-2">
        <?php if(isset($k) AND $k ==0 ){ ?>
            <div class="primary" id="mobile_plus_button">+</div >
        <?php }else{ ?>
            <div class="primary mobile_delete_button" >-</div>
        <?php } ?>
    </div>
</div>