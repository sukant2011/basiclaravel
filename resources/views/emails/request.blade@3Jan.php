<html xmlns="http://www.w3.org/1999/xhtml">
	<body bgcolor="#FFFFFF" style="margin:0; padding:0; height:100%; width:100%;">
      <!-- BODY -->
      <table style="width:100%;">
         <tr>
            <td></td>
            <td bgcolor="#FFFFFF" style="display:block; max-width:600px; margin:0 auto; ">
               <table style="width: 100%;">
                  <tr>
                     <td>
                        <!-- social & contact -->
                        <table class="social" width="100%">
                           <tr style="padding: 15px;">
                              <td style="padding: 15px;">
                                 <!-- column 1 -->
                                 <table align="left" style="width: 270px; float:left; border: 3px solid #ff7c00; margin-right: 10px; height: 460px;">
                                    <tr>
                                       <td style="padding: 15px 0 0 0;">
                                          <div  style="border: 2px solid #e8e4e4; border-radius: 50%;margin: 0 auto;  padding: 20px;text-align: center; width:200px;height:200px;"> 
                                             <img src="{{$data['image']}}" style="<?php echo(strpos($data['image'],'Flying_profile.png')!== false?'height:100%;':'width:200px;height:200px;'); ?> border-radius:50%; text-align:center;" />
                                          </div>
                                          <h5 align="center" style="color: #333; font-size: 30px;   margin: 0;">{{$data['name']}}</h5>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td  background="{{asset('public/img/cloud1.png')}}" style="background-size:100% 100%; height:172px; background-repeat: no-repeat;">
                                          <div style="float:left; padding:20px 14px;">
                                             <div><strong style="float: left; font-size: 14px; margin-right: 3px; width: 50%;">Home University :</strong>  
                                                <span style="float: left; font-size: 14px; margin-right: 3px; width: 47%;">{{$data['homeUniv']}} </span>
                                             </div>
                                             <div><strong style="float: left; font-size: 14px; margin-right: 3px; width: 50%;">Going :</strong>  
                                                <span style="float: left; font-size: 14px margin-right: 3px; width: 47%;">{{$data['going']}} </span> 
                                             </div>
                                             <div><strong style="float: left; font-size: 14px; margin-right: 3px; width: 50%;">Host University :</strong>  
                                                <span style="float: left; font-size: 14px; margin-right: 3px; width: 47%;">{{$data['hostUniv']}}  </span> 
                                             </div>
                                             <div><strong style="float: left; font-size: 14px; margin-right: 3px; width: 50%;">School Term :</strong>  
                                                <span style="float: left; font-size: 14px; margin-right: 3px; width: 47%;">{{$data['schoolterm']}} </span> 
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                 </table>
                                 <!-- /column 1 -->	
                                 <!-- column 2 -->
                                 <table align="center" style="width: 270px; float:left; border: 3px dashed #ff7c00;   padding-bottom: 8px;   height: 460px;">
                                    <tr style="padding: 15px;">
                                       <td style="padding: 15px;">
                                          <p align="center" style="margin-bottom: 10px;font-weight: normal;	font-size:14px line-height:1.6;"><?php echo nl2br($data['message']); ?></p>
                                          <p align="center" style="margin-bottom: 10px;font-weight: normal;	font-size:14px line-height:1.6;">
                                             Reply to <strong>{{$data['name']}}’s</strong><br /> email now: <br/>
                                             <strong><a href="mailto:{{$data['email']}}" align="center" style="color:#000; font-size:14px text-decoration:none;">{{$data['email']}}</a></strong>
                                          </p>
                                          <div  style="height: 150px;   margin: auto auto 20px;  padding: 20px;   text-align: center; width: 150px;"> 
                                             <img src="{{asset('public/img/Flying_profile.png')}}"  style="width: 41%;"/>
                                          </div>
                                       </td>
                                    </tr>
                                 </table>
                                 <!-- /column 2 -->
                                 <span class="clear"></span>	
                              </td>
                           </tr>
                        </table>
                        <!-- /social & contact -->
                     </td>
                  </tr>
               </table>
               <!-- /content -->
            </td>
            <td></td>
         </tr>
      </table>
      <!-- /BODY -->
      <!-- FOOTER -->
   </body>
</html>