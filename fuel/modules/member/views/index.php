<?php $this->load->view('_blocks/header')?>
<div class="login-content">
    <div class="container">
        <div class="login-content-box">
           
            <div class="login-box-inner">
                <form class="form" action="<?php echo base_url()?>member/login" method="post">
                 <input type="hidden" name="forward" value="<?php echo base_url()?>member/welcome">
                <p>Login</p>
                <?php if(!empty($showerror))
                  {
                 ?>
                <div class="invaild"><? echo $showerror; ?> </div>
                 <?php
                 }
                 ?>
                <input class="login-input" type="text" placeholder="Username" value="" name="user_name"/>
                <input class="login-input" type="password" placeholder="Password" value="" name="password"/>
                <br />
                <div class="checkbox"> 
                 <!--<input type="checkbox" value="remember" name="remember"/><span>Remember me</span> -->
                
                <a href="<?php echo base_url()?>member/pwd_reset">Forgot your Password?</a>
                </div>
                <input  class="login-submit"  type="submit" value="Login" name="submit"/>  
                </form>
                <!--<a href="#">Not a member? Sign up now!</a>  -->
            </div>
          </div>
        </div>
   <div class="clear"></div>
 </div>
<?php $this->load->view('_blocks/footer')?>