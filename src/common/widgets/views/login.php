<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */
use yii\helpers\Html;

?>
<form>
    <div class="form-group">
        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
    </div>
    <div class="form-group">
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox"> 记住我
        </label>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-block btn-primary">登录</button>
    </div>

    <p>
        还没有帐号？<?= Html::a('立即注册', ['/register/index']) ?>
    </p>
</form>
