var Url = window.location.protocol + "//" + window.location.hostname;
var connected = false;
const RETRY_INTERVAL = 1000;
var timeout;
var connUrl = 'http://www.flyingchalks.com:3000';

var socket = io.connect(connUrl);
var socketid = '/#';

var user = {};

var selUser ={};
var namelength = 20;
var namelengthCut = 16;

var rTypeArr = new Array();

rTypeArr.push('Peer');
rTypeArr.push('Senior');
rTypeArr.push('Undecided');
rTypeArr.push('Curios Onlooker');

var conversation = [];

var count = 0;

// New socket id

var scrolldiv = true;

var timeperiod = 0;

var friendlist = {};

var navigatePopups = new Array();

var collapsedPopups = new Array();

var chat_SidebarHeight = 0;

var chatbox_height =[];
var divheight = 0;

 //this function can remove a array element.
Array.remove = function(array, from, to) {
    var rest = array.slice((to || from) + 1 || array.length);
    array.length = from < 0 ? array.length + from : from;
    return array.push.apply(array, rest);
};

//this variable represents the total number of popups can be displayed according to the viewport width
var total_popups = 0;

//arrays of popups ids
var popups = [];

var windowloadchatfirst = true;
 	
function openModalPop(obj) {
  
  $('#requestPopUp').find('label.error').hide();
  var uId = $(obj).attr('data-userid');
  var toId = $(obj).attr('data-toid');
  
  var reqType = $(obj).attr('data-type');
  
  $('#uId').val(uId);
  $('#toId').val(toId);
  $('#reqType').val(reqType);
  
  $('#message').val($(obj).attr('data-personalizedMsg'));
  //$('#requestPopUp').modal();
  //$( "#requestForm" ).submit(); 
  

  $.ajax({
      type: "post",
      url: $("#requestForm").attr('action'),
      data: {"uId":uId,"_token": $("#requestForm").attr('tokan'),"toId":toId, "reqType":reqType,"message":$(obj).attr('data-personalizedMsg')},
      dataType: 'json',
      success: function (response) {
        var mq = window.matchMedia( "(min-width: 320px) and (max-width: 740px)" );
        if (mq.matches) {
          window.location.href = Url+'/friendslist?toId='+toId;
          
        }else{
        windowloadchatfirst = false;
         socket.emit('get-friends-list',user);
         setTimeout(function(){ 
          document.getElementById('regOpen_'+toId).onclick();
          },500)
        }
        console.log(response);
      },
      error: function (response) {
        console.log(response);
      }
  });

}
// On page load check user login 

$(document).ready(function(){
  
  
  if(localStorage.getItem("navigatePopups")!=null){

  	var storedNames = JSON.parse(localStorage.getItem("navigatePopups"));
  	console.log(storedNames);
  	setTimeout(function(){ 
  	for(var navPop = 0; navPop < storedNames.length; navPop++){
  		console.log(storedNames[navPop]);
  		document.getElementById('regOpen_'+storedNames[navPop]).onclick();
  	}
  	 },2500)
  }
 
  $('.web-chatsidebar').hide();
  $("#message_count").hide();
  $("#message_notify").hide();
  alertify.set('notifier','position', 'top-right');
 
  
  $.ajax({
    type:'post',
    url: Url+'/logindetails',
    data:{'_token':$('meta[name="_token"]').attr('content')},
    dataType: 'json',
    success:function (data,status) {
      if(data.login==true){
        user = data;		 
        socket.emit('user-login',data);
      }else{
        $("#chatdata").hide();
        $(".popup-head").hide();
      }
    },
    error : function(){
      console.log("Connection Error");
    }
  });

 

  setInterval(function(){
    $(".timesent").each(function(){
      var each = moment($(this).data('time'));
      $(this).text(each.fromNow());
    });
  },600);


  $(window).on('beforeunload', function(){
    socket.close();
    connected = false;
    retryConnectOnFailure(RETRY_INTERVAL);
  });

});



socket.on('connect', function() {
  connected = true;
  clearTimeout(timeout);
});

socket.on('connect_failed', function(){
  connected = false;
  console.log('Connection Failed');
  retryConnectOnFailure(RETRY_INTERVAL);
});

socket.on('disconnect', function() {
  connected = false;
  console.log('disconnected');
  retryConnectOnFailure(RETRY_INTERVAL);
});


  function retryConnectOnFailure(retryInMilliseconds) {
    setTimeout(function() {
      if (!connected) {
          socket.connect();
          $.ajax({
            type:'post',
            url: Url+'/logindetails',
            data:{'_token':$('meta[name="_token"]').attr('content')},
            dataType: 'json',
            success:function (data,status) {
              if(data.login==true){
                user = data;     
                socket.emit('user-login',data);
              }else{
                $("#chatdata").hide();
                $(".popup-head").hide();
              }
            },
            error : function(){
              console.log("Connection Error");
            }
          });

        retryConnectOnFailure(retryInMilliseconds);
      }
    }, retryInMilliseconds);
  }


// start connection
socket.connect();
retryConnectOnFailure(RETRY_INTERVAL);


socket.on('get-userDetails',function(){
  socket.emit('get-friends-list',user);
});






socket.on('friend-list',function(list){
 //console.log(list);
  $("#message_count").html(list.convUser);
  $("#message_notify").html(list.convUser);
  
  if(list.convUser==0){
    $("#message_count").hide();
    $("#message_notify").hide();
  }else{
    $("#message_count").show();
    $("#message_notify").show();
  }


  friendlist = JSON.parse(list.friends_list);

  var friendonline = 0;
  friendlist.forEach(function (friend) {
      if(friend.online=='Y'){
        friendonline +=1;
      }  
  });

  var friends = {friendlist:friendlist,friendonline:friendonline};

  friendListtoHTml(friends,function (res){
  });

  mobilefriendListtoHTml(friends,function (res){
  });

});






socket.on('get-Old-message',function(msgs){
  var checkStatus = false;
  var msgs = JSON.parse(msgs);

  msgs.message.forEach(function(Msg){
    Msg.date = moment.utc(Msg.date).local().format('YYYY-MM-DD HH:mm:ss');
  });
  
  scrolldiv = (msgs.message.length<=0?false:true);
     conversation.forEach(function(data){
      if(data.reciverId==msgs.reciverId){
        checkStatus= true;
        data.scroll = msgs.scroll;
        msgs.message.forEach(function(singleMsg){
          data.message.push(singleMsg);
          data.message =  _.uniqBy(data.message, 'mesgId');
        })
      }
    });

    if(checkStatus!=true){
      conversation.push(msgs);
    }

    if($("#"+msgs.requestId+"-messages").length!=0){
      
      chatbox_height.forEach(function(scl){
        divheight = scl[msgs.requestId];
      });

      
      //$("#"+event.id).scrollTop();
    }

  conversationHTMl(conversation,function(res){
    if(checkStatus!=true){
      if($("#"+msgs.requestId+"-messages").length!=0){
        //$("#"+msgs.requestId+"-messages").animate({ scrollTop: $("#"+msgs.requestId+"-messages")[0].scrollHeight });
        $("#"+msgs.requestId+"-messages").scrollTop($("#"+msgs.requestId+"-messages")[0].scrollHeight);
      }
    }else{
      if(msgs.scroll==true && $("#"+msgs.requestId+"-messages").length!=0){
        console.log(chatbox_height,' inner height ',divheight);
        $("#"+msgs.requestId+"-messages").scrollTop($("#"+msgs.requestId+"-messages")[0].scrollHeight - divheight);
      }
    }

  });
});




socket.on('conversation',function(data){
  var checkStatus = false;
  
  friendlist.forEach(function(friend){
      if(friend.id==data.receive.id){
        selUser = friend;
      }
  });

  var msg = {
    mesgId:data.mesgId,
    message: data.message,
    senderId:data.sender.id,
    reciverId:data.receive.id,
    userId:data.sender.id,
    fname:data.sender.fname,
    lname:data.sender.lname,
    email:data.sender.email,
    date:moment.utc(data.date).local().format('YYYY-MM-DD HH:mm:ss'),
    requestId :data.receive.requestId,
    avatar:data.sender.image
  };
  
  if(parseInt(msg.senderId)==parseInt(user.id)){
    conversation.forEach(function(con){
      if(parseInt(con.reciverId)==parseInt(msg.reciverId)){
        checkStatus= true;
        con.message.push(msg);
        con.message = _.uniqBy(con.message, 'mesgId');
      }
    });
  }

  if(parseInt(msg.reciverId)==parseInt(user.id)){
    conversation.forEach(function(con){
      if(parseInt(con.reciverId)==parseInt(msg.senderId)){
        checkStatus= true;
        con.message.push(msg);
        con.message = _.uniqBy(con.message, 'mesgId');
      }
    });
  }
  
   
  if(checkStatus!=true){
    conversation.push({requestId:msg.requestId,scroll:false,senderId:msg.senderId,reciverId:msg.reciverId,message:[msg]});
  }

  conversationHTMl(conversation,function(res){
    if(data.sender.id!=user.id){
      
      $.notify({
        message: msg.fname+' '+msg.lname+' sent you message' 
      },{ 
        element: '.exchange-notify',
        position: 'absolute',
        type: 'success',
        delay: 3000,
        placement: {
          from: "top",
          align: "center"
        },
        template:'<div data-notify="container" role="alert" class="col-xs-11 col-sm-2 alert alert-{0}" style="margin: 15px 0 15px 0; width: 400px;background-color:#3c763d;color:#fff">\
                <button type="button" class="close" data-notify="dismiss" style="top:7px;">\
                    <span aria-hidden="true">×</span>\
                    <span class="sr-only">Close</span>\
                </button>\
                <span data-notify="icon"></span>\
                <span data-notify="title">{1}</span>\
                <span data-notify="message" style="padding-right:15px">{2}</span>\
            </div>'
      });
      
      //alertify.success(msg.fname+' '+msg.lname+' sent you message ',1500);
    } 
    if($("#"+msg.requestId+"-messages").length!=0){
      $("#"+msg.requestId+"-messages").animate({ scrollTop: $("#"+msg.requestId+"-messages")[0].scrollHeight });
      
      var $collapsed = $("#collapsed-"+data.sender.id);
     
      if (!$collapsed.hasClass('panel-collapsed')) {
        socket.emit('read-messages',{sender:user,receive:selUser}); 
      } 

    }
  });

});



// friend list to html

function frnd_show_hide(){
  var mq = window.matchMedia( "(min-width: 320px) and (max-width: 740px)" );
  if (mq.matches) {
    window.location.href = Url+'/friendslist';
  }else{
    $(".chat-sidebar-main").show();
    if($('.chat-sidebar').hasClass('openList')){
      $('.chat-sidebar').hide();
      $('.chat-sidebar').addClass('closeone');
        $('.chat-sidebar').removeClass('openList');
    }else{

      $('.chat-sidebar').show();
      $('.chat-sidebar').addClass('openList');
        $('.chat-sidebar').removeClass('closeone');
    }
    
  } 
  
}

function frnd_close_complete(){
  var mq = window.matchMedia( "(min-width: 320px) and (max-width: 740px)" );
  if (mq.matches) {
    window.location.href = Url+'/friendslist';
  }else{
    $(".chat-sidebar-main").hide();
    if($('.chat-sidebar').hasClass('openList')){
      $('.chat-sidebar').hide();
      $('.chat-sidebar').addClass('closeone');
        $('.chat-sidebar').removeClass('openList');
    }else{

      $('.chat-sidebar').show();
      $('.chat-sidebar').addClass('openList');
        $('.chat-sidebar').removeClass('closeone');
    }
    
  } 

}






function scrollchatbox(event,id,requestId){
  
    
    $("#loading-"+requestId).remove();
    clearTimeout(timeperiod);
     
    friendlist.forEach(function(friend){
      if(friend.id==id){
        selUser = friend;
      }
    });

    
    conversation.forEach(function(data){
      if(data.reciverId==id){
        scrolldiv = data.scroll;
      }
    });


    if(scrolldiv){
      if(event.scrollTop <= 0){

        conversation.forEach(function(data){
          if(data.reciverId==id){
            
            var scrollheight = $("#"+event.id)[0].scrollHeight;
            var scollrequestId = true;
            chatbox_height.forEach(function(scl){
              if(scl==requestId){
                scollrequestId = false;
                scl = scrollheight;
               
              }
            });

            if(scollrequestId){
              var heightRquestId = {};
              heightRquestId[requestId] =scrollheight;
              chatbox_height.push(heightRquestId);
              
            }


            $("#"+event.id).prepend('<center id="loading-'+requestId+'">loading...</center>');

            
            timeperiod = setTimeout(function(){

              //chatbox_height.requestid = 
              //$("#"+event.id).scrollTop($("#"+event.id).innerHeight());
              count = data.message.length;
              socket.emit('old-messages',{count:count,sender:user,receive:selUser});
            },2000);
          }
        });
      }
    }
    scrollbreak();
}





function friendListtoHTml(friends,callback){
 

  var html = '<div class="chat-sidebar-main">';
  html +='<div class="latu panel-collapsed" id="collapsed_friendbox"  onclick="collapsed_friendbox()" style="cursor: pointer;">';
  //<span class="glyphicon glyphicon-minus pull-right " ></span>
  html +='<h2><span class="" style="width:88%;" > Chat '+(friends.friendonline>0?'('+friends.friendonline+')':'')+' </span> <span onclick="frnd_close_complete()" class="glyphicon glyphicon-remove pull-right"></span> </h2>';
  html += '<div class="chat-sidebar '+(windowloadchatfirst?'closeone" ':'openList')+'" id="two" onscroll="scrollbrek()" '+(windowloadchatfirst?' style="display:none;" ':'')+'>';
  

  if(friends.friendlist.length>0){
    friends.friendlist.forEach(function(friend) {
      html +='<div class="sidebar-name" id="regOpen_'+friend.id+'" onclick="register_popup(\''+friend.id+'\', \''+escape(friend.fname)+' '+escape(friend.lname)+' \',\''+ btoa(JSON.stringify(friend))+'\',\''+friend.requestId+'\')" >';
   
      if(!friend.avatar || friend.avatar=='' ){
        html += '<img src="'+Url+'/public/img/dummy-head.png"/>';
      }else if(friend.avatar.indexOf('http://') === 0 || friend.avatar.indexOf('https://') === 0){
        html += '<img src="'+friend.avatar.replace('=normal', '=large&width=200&height=200')+'"/>'; 
      }else{
        html += '<img src="'+Url+'/public/img/memberImages/'+friend.avatar+'"/>';
      }

      html += (friend.msgcount>0?'<sup class="msg1" >'+friend.msgcount+'</sup>':'');
    
      html += '<span class="name-cl">'+friend.fname+' '+friend.lname+'</span>';
      html += '<span class="user-type">'+rTypeArr[friend.requestType-1]+'</span>';
      html += '<span class="online lonli '+(friend.online!='Y'?'offline':'')+'"></span>';
      //html += '<div class="down-13"><span class="msgcount-user">23'+friend.msgcount+'</span></div>';

      html += '</div>';
    });
  }else{
    html += '<div class="sidebar-name no-friends">No friends</div>';
  }
  html += '</div></div></div>';
  $("#chatdata").html(html);
  // $("#friend_count").html(friends.friendlist.length);
  // if(friends.friendonline>0){
  //   $("#friend_count").show();
  // }else{
  //   $("#friend_count").hide();
  // }
  $("#friend_count").html(friends.friendonline);
   $("#friend_count").hide();
  $(".chat-sidebar").scrollTop(chat_SidebarHeight);


  callback(true);
}


$(window).load(function () {
   // setTimeout(function () {
      //alert($( window ).width());
      if($( window ).width()=='780'){
        $('.chat-sidebar').hide();
        //window.location.href=Url; 
      }
      //$('.chat-sidebar').hide();
     // windowloadchatfirst = false;  
   // }, 10000);
});



function mobilefriendListtoHTml(friends,callback){
  var html =  '<div class="chat-sidebar-main diff-main-online">';
  html += '<div class="latu">';
  html += '<span class="chat-friends intro" id="one">Chat with friends '+(friends.friendonline>0?'('+friends.friendonline+')':'')+'</span>';
  html += '<div class="chat-sidebar" id="two" style="display: block;">';

  if(friends.friendlist.length>0){
    friends.friendlist.forEach(function(friend) {
      html += '<div class="sidebar-name modal-dialog modal-lg btn btn-info btn-lg" id="regOpenMob_'+friend.id+'" onclick="mobilepopmodel(\''+friend.id+'\', \''+escape(friend.fname)+' '+escape(friend.lname)+'\',\''+ btoa(JSON.stringify(friend))+'\',\''+friend.requestId+'\')">';
      html += '<a href="#">';

      if(!friend.avatar || friend.avatar==''){
        html += '<img src="'+Url+'/public/img/dummy-head.png"/>';
      }else if(friend.avatar.indexOf('http://') === 0 || friend.avatar.indexOf('https://') === 0){
        html += '<img src="'+friend.avatar.replace('=normal', '=large&width=200&height=200')+'"/>'; 
      }else{
        html += '<img src="'+Url+'/public/img/memberImages/'+friend.avatar+'"/>';
      }
      html += (friend.msgcount>0?'<sup class="msg1" >'+friend.msgcount+'</sup>':'');
      html += '<span class="name-cl">'+friend.fname+' '+friend.lname+'</span>';
      html += '<span class="user-type">'+rTypeArr[friend.requestType-1]+'</span>';
      html += '<div class="pull-right online-chat">';
      
      html += '<span class="online '+(friend.online!='Y'?'offline':'')+'"></span>';
      html += '<img src="'+Url+'/public/img/msg-ic.png" class="msg-ic">';
      html += '</div></span></a></div>';
    });
  }else{
    html += '<div class="no-friends">No friends</div>';
  }
  html += '</div></div></div>';
  $("#mobilechatView").html(html);
  // if(friends.friendonline>0){
  //   $("#friend_count").show();
  // }else{
  //   $("#friend_count").hide();
  // }
  $("#friend_count").hide();
  $("#friend_count").html(friends.friendonline);
  $("#friend_count").html(friends.friendlist.length);

  callback(true);
}






// function friendListtoHTml(friends,callback){

//     var html = "<center><span>List of Online People</span></center>";
    
//     friends.forEach(function(per) {
//         html += '<div class="col-md-8 person_list" style="display:'+(per.to_id==user.id?'none':'block')+'" onclick=\'persondata("'+ btoa(JSON.stringify(per))+'")\'>';
//         html += '<span>&nbsp; '+per.fname+' '+per.lname+'</span>';
//         html += '<span class="online" style="background-color:'+(per.online=='Y'?'#0EE700':'red')+'">&nbsp;&nbsp;&nbsp;&nbsp;';
//         html +=  (per.messageCount>0?per.messageCount:'')+'</span>';
//         html += '</div>';
//     });
    
//     $("#friend-list").html(html);     
//     callback(true);
// }





// coonversation messages block 

function conversationHTMl(messagesdata,callback){
  
    //
    messagesdata.forEach(function(msgblock){

      messages = _.sortBy(msgblock.message, function(o) {  
        return o.mesgId; 
      });
      var html = '<div class="body-modal">'; 
      if(messages.length>0){
          messages.forEach(function(msg){
            html += '<p class="'+(user.id== msg.userId?'you':'me')+'">';
            if(!msg.avatar || msg.avatar==''){
              html += '<img src="'+Url+'/public/img/dummy-head.png"/>';
            }else if(msg.avatar.indexOf('http://') === 0 || msg.avatar.indexOf('https://') === 0){
              html += '<img src="'+msg.avatar.replace('=normal', '=large&width=50&height=50')+'"/>'; 
            }else{
              html += '<img src="'+Url+'/public/img/memberImages/'+msg.avatar+'"/>';
            }
             
            html += '<span class="msg-box">'+msg.message+'</span>';
            html += '<span class="time-msgbox timesent" data-time="'+ msg.date +'" >'+moment(msg.date).fromNow()+'</span>';
            html += '</p>';

          });
      }else {
          html += '<p>Start a conversation!</p>';
      }
      html += '</div>';
      $("#"+msgblock.requestId+"-messages").html(html);

    });
 
  
  callback(true);
}







// click event to chat user

function persondata(data){
    conversation = [];
    count = 0;
    selUser = JSON.parse(atob(data));
    socket.emit('old-messages',{count:count,sender:user,receive:selUser});
}



// click event to send message



function sendMessage(event,id){
  
  var message = $.trim($("#msg-"+id).val());
  var checkStatus = false;
  var date = new Date(); //moment().format('YYYY-MM-DD HH:mm:ss');

  friendlist.forEach(function(friend){
    if(friend.id==id){
      selUser = friend;
    }
  });
   
  if(message.length!=0){
    $("#msg-"+id).val('');
    if(selUser.online!='Y'){
      $.ajax({
        type:'post',
        url: Url+'/send-message-offline',
        data:{'_token':$('meta[name="_token"]').attr('content'),message:message,reciverId:selUser.id},
        dataType: 'json',
        success:function (data,status) {
          if(data.login==true){

          }
        },
        error : function(){
          console.log("Connection Error");
        }
      });
    }

    socket.emit('send-message',{date:date,message:message,sender:user,receive:selUser});
  }
}


function onkeypressinput(event,id){
    var key = event.which;
    if(key == 13){
      var content = $(".msgInput").val();  
      var caret = getCaret(this);
      if(event.shiftKey){
            this.value = content.substring(0, caret - 1) + "\n" + content.substring(caret, content.length);
            event.stopPropagation();
      } else { 
        sendMessage(event,id);
        event.preventDefault();
      }
      
    }
 
}

function getCaret(el) { 
    if (el.selectionStart) { 
        return el.selectionStart; 
    } else if (document.selection) { 
        el.focus();
        var r = document.selection.createRange(); 
        if (r == null) { 
            return 0;
        }
        var re = el.createTextRange(), rc = re.duplicate();
        re.moveToBookmark(r.getBookmark());
        rc.setEndPoint('EndToStart', re);
        return rc.text.length;
    }  
    return 0; 
}

function mobilepopmodel(id, name, data,requestId){
  count = 0;
  
  friendlist.forEach(function(friend){
    if(friend.id==id){
      selUser = friend;
    }
  });

  //

  html = '<div class="modal fade modal-inner" id="myModalchat" role="dialog">';
  html += '<div class="modal-dialog">';
  html += '<div class="modal-content" id="'+id+'-modelpopup">';
  html += '<p class="top-barmodal1  pr0">';
  // '<span class="online '+(selUser.online!='Y'?'offline':'')+'"></span>'+
  html += unescape(name)+' <span class="close-sign glyphicon glyphicon-remove pull-right " onclick="modelpopclose('+id+','+requestId+')"></span>';
  html += '</p>';

  html += '<div id="'+requestId+'-messages" onscroll="scrollchatbox(this,'+id+','+requestId+')" class="model-scroll">';
  html += '</div>';

  html += '<div class="modl-footer">';
  //html += '<input type="text" onkeypress="onkeypressinput(event,'+id+')" id="msg-'+id+'" data-user="'+data+'"></input>';
   html += '<textarea class="msgInput" onkeypress="onkeypressinput(event,'+id+')" id="msg-'+id+'" data-user="'+data+'"></textarea>';
  html += '<button onclick="sendMessage(this,'+id+');"><img src="'+Url+'/public/img/send.png"></button>';
  html += '</div></div></div></div>';

  $("#modelmobilechatView").html(html);
  $('#myModalchat').modal('show');
  socket.emit('old-messages',{count:count,sender:user,receive:selUser});
  setTimeout(function(){
    console.log('#'+id+'-modelpopup');
    
   $('#'+id+'-modelpopup').find('.model-scroll').scrollTop( document.getElementById(id+'-modelpopup').scrollHeight );

  },300)
 

}


function modelpopclose(id,requestId){
  $('#'+id+'-modelpopup').remove();
  $('#myModalchat').modal('hide');
  conversation.forEach(function(data,index){
    if(data.requestId==requestId){
      conversation.splice(index,1);
    }
  });
  
}


function collapsed_friendbox(){

   var $this = $("#collapsed_friendbox");
    if (!$this.hasClass('panel-collapsed')) {
        
         $('.chat-sidebar').addClass('closeone');
        $('.chat-sidebar').removeClass('openList');


        $('.chat-sidebar').slideUp();
        $('.chat-sidebar').slideUp();
        $this.addClass('panel-collapsed');
        //$this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
        
    } else {

        $('.chat-sidebar').slideDown();
        $('.chat-sidebar').slideDown();
       $('.chat-sidebar').addClass('openList');
        $('.chat-sidebar').removeClass('closeone');
        //$this.removeClass('glyphicon-plus').addClass('glyphicon-minus');
        $this.removeClass('panel-collapsed');
    }

   
}

function collapsed(id,requestid){
  var $this = $("#collapsed-"+id);
    if (!$this.hasClass('panel-collapsed')) {
        $('#'+requestid+'-messages').slideUp();
        $('#'+requestid+'-inputsendbox').slideUp();
        $this.addClass('panel-collapsed');
        $this.addClass('');
        
        var nameTitle = $.trim(unescape($this.attr('org-name')));
        
        //console.log(nameTitle.length);

        var trimmedString = nameTitle.length >= namelength ? 
                    nameTitle.substring(0, namelengthCut)+"..." : 
                    nameTitle;
       // console.log(trimmedString);
        $this.text(trimmedString);       
        //$this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
        $('#'+id).css({'width':'200px'});
		    collapsedPopups.push(id);
        localStorage.setItem( 'collapsedPopups', JSON.stringify(uniqueARR(collapsedPopups)) );
        console.log(collapsedPopups);
        
    } else {
        deleteColladpsedPopups(id);
        $this.text(unescape($this.attr('org-name')));           
        $('#'+requestid+'-messages').slideDown();
        $('#'+requestid+'-inputsendbox').slideDown();
        //$this.removeClass('glyphicon-plus').addClass('glyphicon-minus');
        $('#'+id).css({'width':'290px'});
        $this.removeClass('panel-collapsed');
    }


    popups.forEach(function(value,index){
      if(value==id){

        for(pop=index+1;pop<=popups.length;pop++){
          if($("#collapsed-"+popups[pop-1]).hasClass('panel-collapsed')){
            $('#'+popups[pop]).css({'right':(parseInt($("#"+popups[pop-1]).css('right'))+240)+'px'});
          }else{
            $('#'+popups[pop]).css({'right':(parseInt($("#"+popups[pop-1]).css('right'))+320)+'px'});
          }
        }

      } 
    }); 
}

function uniqueARR(list) {
    var result = [];
    $.each(list, function(i, e) {
        if ($.inArray(e, result) == -1) result.push(e);
    });
    return result;
}

//creates markup for a new popup. Adds the id to popups array.
function register_popup(id, name, data,requestId){

	  navigatePopups.push(id);
    localStorage.setItem( 'navigatePopups', JSON.stringify(uniqueARR(navigatePopups)) );

    chat_SidebarHeight = $(".chat-sidebar").scrollTop();

    if ($("#collapsed-"+id).hasClass('panel-collapsed')) {
        $('#'+requestId+'-messages').slideDown();
        $('#'+requestId+'-inputsendbox').slideDown();
        $("#collapsed-"+id).removeClass('panel-collapsed');
        //$("#collapsed-"+id).removeClass('glyphicon-plus').addClass('glyphicon-minus');
        $('#'+id).css({'width':'300px'});
		
    }

    //conversation = [];
    count = 0;
    selUser = JSON.parse(atob(data));   
    socket.emit('old-messages',{count:count,sender:user,receive:selUser});  
    for(var iii = 0; iii < popups.length; iii++)
    {  
        //already registered. Bring it to front.
        if(id == popups[iii])
        {
            Array.remove(popups, iii);
       
            popups.unshift(id);
           
            calculate_popups();
        
            return;
        }
    }  
     var styleNone = '';
     var dClass= '';
     var topMainStyle = '';
     var nameTitle = unescape(name);
     var orgName = nameTitle;

     if(localStorage.getItem("collapsedPopups")!=null){

      var collapsedIds = JSON.parse(localStorage.getItem("collapsedPopups"));
      console.log(collapsedIds);

      for(var cId = 0; cId < collapsedIds.length; cId++){
           if(collapsedIds[cId]==id){
              styleNone = 'style="display:none;"';
              dClass = 'panel-collapsed';
              topMainStyle = 'style="width:200px;"';
              nameTitle = unescape(name);
             console.log(nameTitle);
              nameTitle = nameTitle.length >= namelength ? 
                          nameTitle.substring(0, namelengthCut)+"..." : 
                          nameTitle;
                        
             
              break;
          }
      }
     
    }
 
    
  
    var element = '<div class="popup-box chat-popup  de-top" id="'+ id +'" '+topMainStyle+'>';
    element = element + '<div class="popup-head top-barmodal" id="'+id+'-head">';
    element = element + '<div class="popup-head-left '+dClass+'" style="width:82%;" id="collapsed-'+id+'" org-name="'+escape(orgName)+'" onclick="collapsed(\''+ id +'\',\''+requestId+'\')" >'+ nameTitle +'</div>';
    element = element + '<div class="popup-head-right w15" onclick="close_popup(\''+ id +'\',\''+requestId+'\');" ><span class="close-sign glyphicon glyphicon-remove pull-right"></span></div>';
    //element = element + '<div class="popup-head-right" ><span class="close-sign  glyphicon glyphicon-minus pull-right open-box" id="collapsed-'+id+'" onclick="collapsed(\''+ id +'\',\''+requestId+'\')"></span></div>';
    element = element + '<div style="clear: both"></div>';
    element = element + '</div>';
    element = element + '<div class="popup-messages"  onscroll="scrollchatbox(this,'+id+','+requestId+')" id="'+requestId+'-messages" '+styleNone+'>';
    
    // element = element + '<div class="body-modal">';
    // element = element + '<p><img src="http://www.flyingchalks.com/dev/public/img/dummy.jpg"><span class="msg-box"></span></p>';
    // element = element +  '<p><img src="http://www.flyingchalks.com/dev/public/img/dummy.jpg"><span class="time-msgbox">Monday at 7:45 PM<span class="msg-box"></span></span></p>';
    // element = element +  '<p><img src="http://www.flyingchalks.com/dev/public/img/dummy.jpg"><span class="msg-box"></span></p>';
    // element = element +  '<p><img src="http://www.flyingchalks.com/dev/public/img/dummy.jpg"><span class="time-msgbox">Monday at 7:45 PM<span class="msg-box"></span></span></p>';
    // element = element + '</div>';
    element = element + '</div>'; 

    element = element + '<div class="modl-footer" id="'+requestId+'-inputsendbox" '+styleNone+'>';
    //element = element + '<input type="text" class="msgInput" onkeypress="onkeypressinput(event,'+id+')" id="msg-'+id+'" ><button onclick="sendMessage(this,'+id+');" ><img src="http://www.flyingchalks.com/dev/public/img/send.png"></button>';
    element = element + '<textarea  class="msgInput" onkeypress="onkeypressinput(event,'+id+')" id="msg-'+id+'" ></textarea><button onclick="sendMessage(this,'+id+');" ><img src="'+Url+'/public/img/send.png"></button>';
    element = element + '</div>';
    element = element + '</div>';


    $(".chatbox-main").append(element);
    popups.unshift(id);
           
    calculate_popups();
   // $('.popup-messages').scrollTop($('.popup-messages')[0].scrollHeight);

   
}

function deleteNavigatePopups(id){

	 if(localStorage.getItem("navigatePopups")!=null){
	  	var resultArray = JSON.parse(localStorage.getItem("navigatePopups"));
	  	
	  	for(var navPop1 = 0; navPop1 <= resultArray.length; navPop1++){
	  		 if(resultArray[navPop1] == id){
			        resultArray.splice(navPop1,1);
			        localStorage.setItem( 'navigatePopups', JSON.stringify(resultArray) );
			    }
	  	}
	  	localStorage.removeItem(id);
	  }	
	
}

function deleteColladpsedPopups(id){

   if(localStorage.getItem("collapsedPopups")!=null){
      var resultArray1 = JSON.parse(localStorage.getItem("collapsedPopups"));
      
      for(var navPop2 = 0; navPop2 <= resultArray1.length; navPop2++){
         if(resultArray1[navPop2] == id){
              resultArray1.splice(navPop2,1);
              localStorage.setItem( 'collapsedPopups', JSON.stringify(resultArray1) );
          }
      }
      localStorage.removeItem(id);
    } 
  
}

//calculate the total number of popups suitable and then populate the toatal_popups variable.
function calculate_popups(){
    var width = window.innerWidth;

    if(width < 540)
    {
        total_popups = 0;
    }
    else
    {
        width = width - 200;
        //320 is width of a single popup box
        total_popups = parseInt(width/320);
    }
   
    display_popups();
   
}


//this is used to close a popup
function close_popup(id,requestId)
{
	deleteNavigatePopups(id);	
    conversation.forEach(function(data,index){
      if(data.requestId==requestId){
        conversation.splice(index,1);
      }
    });

    for(var iii = 0; iii < popups.length; iii++)
    {
        if(id == popups[iii])
        {
            Array.remove(popups, iii);
           
            document.getElementById(id).style.display = "none";
            
            $("#"+id).remove();

            calculate_popups();
           
            return;
        }
    }  

}



//displays the popups. Displays based on the maximum number of popups that can be displayed on the current viewport width
function display_popups()
{
	
  //console.log(' total popups ',total_popups,' popups ',popups);
   var right = 250;
   
    var iii = 0;
    for(iii; iii < total_popups; iii++)
    {
        if(popups[iii] != undefined)
        {
            var element = document.getElementById(popups[iii]);
           element.style.right = right + "px";
            right = right + 320;
            element.style.display = "block";
        }
    }

    if(total_popups<popups.length){

    }
   
    for(var jjj = iii; jjj < popups.length; jjj++)
    {
        var element = document.getElementById(popups[jjj]);
        element.style.display = "none";
    }
     

     for(pop=0;pop<=popups.length;pop++){
        if($("#collapsed-"+popups[pop-1]).hasClass('panel-collapsed')){
          $('#'+popups[pop]).css({'right':(parseInt($("#"+popups[pop-1]).css('right'))+240)+'px'});
        }else{
          $('#'+popups[pop]).css({'right':(parseInt($("#"+popups[pop-1]).css('right'))+320)+'px'});
        }
      }
}