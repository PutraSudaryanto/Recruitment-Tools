<?php
/**
 * @var $this SiteController
 * @var $model LoginForm
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2012 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Core
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Scanner',
	);
?>
<?php 
	$cs = Yii::app()->getClientScript();
        $linkScanUser = Yii::app()->controller->createUrl('getdatabarcode');

$js=<<<EOP
	
	$('input#auto_barcode_input').focus();
    
	
	$('input#auto_barcode_input').keyup(function(e){
		
                var code = $(this).val();
                $.ajax({
                        type : 'post',
                        url : '$linkScanUser',
                        data : {'autocode':code},
                        dataType : 'json',
                        success : function(res){
                                $('#print_result').html(res.message);
                        }
                });
	});
        
	$('input#code_barcode_input').keypress(function(e){
                if(e.which == 13) {
                    var code = $(this).val();		
                    $.ajax({
                            type : 'post',
                            url : '$linkScanUser',
                            data : {'code':code},
                            dataType : 'json',
                            success : function(res){
                                    $('#print_result').html(res.message);
                            }
                    });
                }
	});
        
	$('input#test_number_input').keypress(function(e){
                if(e.which == 13) {
                    var code = $(this).val();		
                    $.ajax({
                            type : 'post',
                            url : '$linkScanUser',
                            data : {'test_number':code},
                            dataType : 'json',
                            success : function(res){
                                    $('#print_result').html(res.message);
                            }
                    });
                }
	});
	
	
EOP;
	$ukey = md5(uniqid(mt_rand(), true));
	$cs->registerScript($ukey, $js, CClientScript::POS_END);
?>
<div class="scanner-form">
    <h2 class="center">ABSENSI REKRUITMENT PLN</h2><hr/>
    <div class="mt-15" ></div>
	<div class="form-barcode">
            Auto Barcode <input type="text" name="barcode_input" id="auto_barcode_input"  />
	</div>
        <div class="mt-15" ></div>
	<div class="form-testnumber">
		Barcode No <input type="text" name="barcode_input" id="code_barcode_input" />
	</div>
        <?php /*
        <div class="mt-15" ></div>
	<div class="form-testnumber">
		Testnumber <input type="text" name="barcode_input" id="test_number_input" />
                
	</div>*/ ?>
        <div class="mt-15" ></div>
        <h1>DATA PESERTA</h1>
        
        <div id="print_result"></div>
</div>