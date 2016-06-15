<html lang="en-US">
   <head>
      <meta charset="utf-8">

   </head>

   <body>
      <p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>
      <table style="border-collapse: collapse; border-spacing: 0;background-color: #F0F8FA; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="center"><tbody><tr style="height: 36px;" height="36"><td style="width: 30px;background-color: #F0F8FA;" width="30" valign="middle"><span style="background-color: #F0F8FA;">&nbsp;</span></td><td style="width: 500px;background-color: #F0F8FA;" width="500" valign="middle" align="center">
  <span style="font-size: medium;background-color: #F0F8FA;text-align: center;float: left;width: 100%;">
  	<img src="{{asset('public/img/inner_logo.png')}}" style="
    text-align: center;
">
  </span>
</td><td style="width: 30px;background-color: #F0F8FA;" width="30" valign="middle"><span style="background-color: #F0F8FA;">&nbsp;</span></td></tr><tr><td style="height: 20px;" colspan="3" valign="top"><br></td></tr><tr><td style="width: 30px;" width="30" valign="top"><br></td><td style="width: 500px;" width="500" valign="top"><span style="font-family: Arial,Helvetica,sans-serif;"> <table style="border-collapse: collapse; border-spacing: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left"><tbody><tr><td valign="top">Hi <span style="text-transform: capitalize;">{{$data['fname']}}<span>,</span></span></td></tr><tr><td style="height: 25px;" valign="top"><br></td></tr><tr><td valign="top"><p>Welcome to Flying Chalks! In order to get started, you need to confirm your email address.</p>
<p style="width: 100%;text-align: center;float: left;margin-top: 18px;"><a  href="{{ URL::to('register/verify/' . $data['confirmation_code']) }}" ><img src="{{asset('public/img/confirm-email.png')}}"></a></p></td></tr></tbody></table></span></td><td style="width: 30px;" width="30" valign="top"><br></td></tr><tr><td style="height: 20px;" colspan="3" valign="top"><br></td></tr><tr><td style="width: 30px;background-color: #F0F8FA;" width="30" valign="top"><br></td><td style="background-color: #F0F8FA; padding: 15px 0;" valign="top"><span style="background-color: #eeeeee;"><span style="font-family: Arial,Helvetica,sans-serif;"> <table style="border-collapse: collapse; border-spacing: 0; text-align: justify; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="left"><tbody><tr><td style="width: 500px; height: 20px;" width="500" valign="top" align="center"><p style="float: left;text-align: left;">Cheers,<br>Flying Chalks Team</p><p style="
    float: left;
    width: 100%;
    text-align: center;
    /* margin: 0; */
    /* padding: 0; */
"><br>
<a href="https://www.facebook.com/flyingchalks" style="text-decoration: none;" target="_blank"><img src="{{asset('public/img/email_fb_icon.png')}}" style="
    text-align: center;
    margin-right: 10px;
">
</a>
<a href="https://www.instagram.com/flyingchalks/" style="text-decoration: none;" target="_blank"><img src="{{asset('public/img/email_insta_icon.png')}}" style="
    text-align: center;
">
</a>
</p>
<div style="padding: 0px; text-align: center; margin: 0px auto; width: 45%;">
	<p style="float: left; margin: 0px 3px 0px 0px;">Sent with 
	<img src="{{asset('public/img/heart_like.png')}}"> 
	from Flying Chalks</p>

</div></td></tr></tbody></table></span> </span></td><td style="width: 30px;background-color: #F0F8FA;" width="30" valign="top"><span style="background-color: #eeeeee;">&nbsp;</span></td></tr></tbody></table>
      <p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>
   </body>
</html>
	