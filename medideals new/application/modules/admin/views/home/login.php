<style>
    body {
        background-image:url('/assets/images/background.jpg');
        min-height: 100vh;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        padding: 15px;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        position: relative;
        z-index: 1;
      }
    .avatar {background-image:url('/_assets/images/login-cover.png')}
    
</style>
<div class="container">
    <div class="login-container">
        <div id="output">
            <?php
                if ($this->session->flashdata('err_login')) {
            ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('err_login') ?></div>
            <?php
                }
            ?>
        </div>
        <div class="avatar"></div>
        <div class="form-box">
            <form action="" method="POST">
                <input type="text" name="username" placeholder="username">
                <input type="password" name="password" placeholder="password">
                <button class="btn btn-info btn-block login" type="submit">Login</button>
            </form>
        </div>
    </div>
</div>