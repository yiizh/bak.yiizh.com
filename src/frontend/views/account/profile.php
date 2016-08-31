<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\assets\fullAvatarEditor\FullAvatarEditorAsset;
use common\models\User;
use common\widgets\JsBlock;
use common\widgets\Panel;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var $this View
 * @var $model User
 */

$this->title = '个人资料';

$fullAvatarEditor = FullAvatarEditorAsset::register($this);
$uploadAvatarUrl = Url::to(['/upload/fullavatareditor']);
$avatarUrlInputId = Html::getInputId($model, 'avatar');

?>
<?php JsBlock::begin() ?>
<script>
    swfobject.addDomLoadEvent(function () {
        var avatarEditorCallback = function (msg) {
            switch (msg.code) {
                case 1 :
                    console.log("页面成功加载了组件！");
                    break;
                case 2 :
                    console.log("已成功加载图片到编辑面板。");
                    break;
                case 3 :
                    if (msg.type == 0) {
                        console.log("摄像头已准备就绪且用户已允许使用。");
                    }
                    else if (msg.type == 1) {
                        alert("摄像头已准备就绪但用户未允许使用！");
                    }
                    else {
                        alert("摄像头被占用！");
                    }
                    break;
                case 5 :
                    if (msg.type == 0) {
                        if (msg.content.success) {
                            setAvatar(msg.content.sourceUrl);
                            $('#modal-upload-avatar').modal('hide');
                        } else {
                            alert(msg.content.msg);
                        }
                    }
                    break;
            }
        };

        var avatarEditor = new fullAvatarEditor("<?=$fullAvatarEditor->baseUrl?>/fullAvatarEditor.swf", "<?=$fullAvatarEditor->baseUrl?>/expressInstall.swf", "swfContainer", {
            id: 'avatarEditor',
            upload_url: '<?=$uploadAvatarUrl?>',	//上传接口
            method: 'post',	//传递到上传接口中的查询参数的提交方式。更改该值时，请注意更改上传接口中的查询参数的接收方式
            src_upload: 0,		//是否上传原图片的选项，有以下值：0-不上传；1-上传；2-显示复选框由用户选择
            avatar_box_border_width: 1,
            tab_visible: false,// 不显示默认选项卡
            avatar_sizes: '180*180',
            avatar_sizes_desc: '180*180像素'
        }, avatarEditorCallback);

    });

    $(document).on('change', '#<?=$avatarUrlInputId?>', function () {
        $('#avatar-preview').attr('src', $(this).val());
    });

    function setAvatar(avatarUrl) {
        $('#<?=$avatarUrlInputId?>').val(avatarUrl);
        $('#<?=$avatarUrlInputId?>').change();
    }
</script>
<?php JsBlock::end() ?>
<div class="account-profile">
    <?php Panel::begin([
        'title' => $this->title
    ]) ?>
    <div class="row">
        <div class="col-xs-9">
            <?php $form = ActiveForm::begin() ?>

            <?= $form->field($model, 'avatar')->hiddenInput()->label(false) ?>
            <div class="form-group row">
                <div
                    class="col-xs-4"><?= Html::img($model->getAvatarUrl(), ['id' => 'avatar-preview', 'class' => 'img-thumbnail']) ?></div>
                <div class="col-xs-4">
                    <p>
                        <?= Html::a('上传头像', '#', ['class' => 'btn btn-success', 'data' => [
                            'toggle' => 'modal',
                            'target' => '#modal-upload-avatar'
                        ]]) ?>
                    </p>
                </div>
            </div>

            <?= $form->field($model, 'name')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton('保存个人资料', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end() ?>
        </div>
    </div>
    <?php Panel::end() ?>
</div>
<?php Modal::begin([
    'id' => 'modal-upload-avatar',
    'header' => '<h4 class="modal-title">上传头像</h4>',
    'size' => Modal::SIZE_LARGE
]) ?>
<div class="text-center">
    <p id="swfContainer">本组件需要安装Flash Player后才可使用，请从<a href="http://www.adobe.com/go/getflashplayer">这里</a>下载安装。</p>
</div>
<?php Modal::end() ?>
