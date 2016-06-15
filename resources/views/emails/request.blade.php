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
                                       <td style="padding: 15px 0 0 0;" align="center">
                                          <div  style="border: 2px solid #e8e4e4; border-radius: 50%;padding:20px;text-align: center; width:150px;height:150px;"> 
                                             <img src="{{$data['image']}}" style="<?php echo(strpos($data['image'],'Flying_profile_.png')!== false?'height:100%;width:64px;':'width:150px;height:150px;border-radius:50%;'); ?>  text-align:center;" />
                                          </div>
                                          <h5 align="center" style="color: #333; font-size: 30px;   margin: 0;">{{$data['name']}}</h5>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td  background="{{asset('public/img/cloud1.png')}}" style="background-size:100% 100%; height:172px; background-repeat: no-repeat;">
											<table width="100%">
												<tr  valign="top">
													<td align="right" width="50%"><strong style="font-size: 14px;">Home University :</strong></td>
													<td width="50%"><span style="font-size: 14px;">{{$data['homeUniv']}} </span></td>
												</tr>
													 <?php if($data['userType']=='1' || $data['userType']=='2'){ ?>
												<tr  valign="top">
													<td align="right" width="50%"><strong style="font-size: 14px;">{{$data['senderType']}} :</strong></td>
													<td width="50%"><span style="font-size: 14px;">{{$data['going']}} </span></td>
												</tr>
												<tr  valign="top">
													<td align="right" width="50%"><strong style="font-size: 14px;">Host University :</strong>  </td>
													<td width="50%"><span style="font-size: 14px;">{{$data['hostUniv']}}  </span></td>
												</tr>
												<tr  valign="top">
													<td align="right" width="50%"><strong style="font-size: 14px;">School Term :</strong>   </td>
													<td width="50%"> <span style="font-size: 14px;">{{$data['schoolterm']}} </span> </td>
												</tr>
												 <?php }else{ ?>
												<tr  valign="top">
													<td align="right" width="50%"><strong style="font-size: 14px;">Matriculation Year :</strong>  </td>
													<td width="50%"><span style="font-size: 14px;">{{$data['matricYear']}} </span> </td>
												</tr>
												<?php } ?>
											</table>
										  
                                       </td>
                                    </tr>
                                 </table>
                                 <!-- /column 1 -->	
                                 <!-- column 2 -->
                                 <table align="center" style="width: 270px; float:left; border: 3px dashed #ff7c00;   padding-bottom: 8px;   padding-top: 30px; height: 460px;font-size:14px;">
                                    <tr>
                                       <td style="padding:0 15px;vertical-align: top;" align="center" >
                                          <p align="center" style="min-height: 162px;margin: 0px;font-size:13px;"><?php echo nl2br(substr($data['message'],0,400)); ?></p>
                                          <p align="center" style="margin-bottom: 20px;">
                                             Reply to <strong>{{$data['name']}}’s</strong><br /> email now: <br/>
                                             <strong><a href="mailto:{{$data['email']}}" align="center" style="color:#000; font-size:14px text-decoration:none;">{{$data['email']}}</a></strong>
                                          </p>
                                          <div  style="min-height: 120px; text-align: center; width: 150px;"> 
                                             <img src="{{asset('public/img/Flying_profile_.png')}}"  style="width: 30%;"/>
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