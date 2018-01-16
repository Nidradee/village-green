<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use backend\models\menu;
use backend\models\submenus;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

$this->title = 'Pages';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs("CKEDITOR.plugins.addExternal('colorbutton', '/village-green/backend/web/ckeditor/plugins/colorbutton/plugin.js', '');");
$this->registerJs("CKEDITOR.plugins.addExternal('font', '/village-green/backend/web/ckeditor/plugins/font/plugin.js', '');");
$this->registerJs("CKEDITOR.plugins.addExternal('image2', '/village-green/backend/web/ckeditor/plugins/image2/plugin.js', '');");
$this->registerJs("CKEDITOR.plugins.addExternal('widget', '/village-green/backend/web/ckeditor/plugins/widget/plugin.js', '');");
$this->registerJs("CKEDITOR.plugins.addExternal('imageuploader', '/village-green/backend/web/ckeditor/plugins/imageuploader/plugin.js', '');");
$this->registerJs("CKEDITOR.plugins.addExternal('btgrid', '/village-green/backend/web/ckeditor/plugins/btgrid/plugin.js', '');");

?>

  <?php $form = ActiveForm::begin(); ?>

  <div class="container">
    <div class="row">
      <div class="col-md-1">
      </div>
      <div class="col-md-10">

        <?= $form->field($model,'menu_id')->dropdownList(
           ArrayHelper::map(menu::find()->all(),'menu_id', 'menu_name'),
        ['prompt' => 'Select Menu Name']); ?>

        <? $tempVar = ArrayHelper::map(menu::find()->all(),'menu_id', 'menu_name');
          ?>

        <?= $form->field($model,'submenu_id')->widget(DepDrop::classname(), [
            'pluginOptions'=>[
                'depends'=>[Html::getInputId($model, 'menu_id')],
                'placeholder'=>'Select Submenu',
                'url'=>Url::to(['/app/subcat'])
            ]
        ]);?>

        <br>

          <?= $form->field($model, 'page_html')->widget(CKEditor::className(), [
                       'clientOptions' => [
                      'extraPlugins' => 'btgrid,colorbutton,font,image2,widget,imageuploader,templates',
                        'toolbarGroups' => [
                            ['name' => 'undo'],
                            ['name' => 'colors'],
                            ['name' => 'links', 'groups' => ['links', 'insert']],
                            ['name' => 'others', 'groups' => ['others', ]],
                            ['name' => 'document', 'groups' => ['mode', ]],
                            ['name' => 'paragraph', 'groups' => ['list','blocks']], // <--- OUR NEW PLUGIN YAY!
                            ['name' => 'styles'], // <--- OUR NEW PLUGIN YAY!
                            ['name' => 'btgrid'], // <--- OUR NEW PLUGIN YAY!

                        ]
                    ],
                       'preset' => 'full'
                   ]) ?>
              <br>
              <br>

              <div class="form-group">
                <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
              </div>
      </div>
      <div class="col-md-1">
      </div>
    </div>
    <?php ActiveForm::end() ?>
  </div>