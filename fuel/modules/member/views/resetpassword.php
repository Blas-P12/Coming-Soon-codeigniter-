<?php $this->load->view('_blocks/header')?>
<style>
.login-box-inner{
   height: 259px; }
</style>
<div class="login-content">
    <div class="container">
        <div class="login-content-box">
           
            <div class="login-box-inner">
                <form class="form" action="<?php echo base_url()?>member/pwd_reset" method="post">
                 <input type="hidden" name="forward" value="<?php echo base_url()?>member/welcome">
                <p>Reset Password</p>
                <? if(!empty($error))
                  {
                 ?>
                <div class="invaild"><? echo $error[0]; ?> </div>
                 <?
                 }
                 ?>
                <input class="login-input" type="text" placeholder="Email" value="" name="email"/>
                
                <br />
                <div class="checkbox"> 
                 <!--<input type="checkbox" value="remember" name="remember"/><span>Remember me</span> -->
                
                
                </div>
                <input  class="login-submit"  type="submit" value="SUBMIT" name="submit"/>  
                </form>
                
            </div>
          </div>
        </div>
   <div class="clear"></div>
 </div>
<?php $this->load->view('_blocks/footer')?>