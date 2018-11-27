<!DOCTYPE html>
<html lang="en">
<head>
  <title>ChatBox</title>
  <meta charset="utf-8">
  <meta name="csrf_token" content="{{csrf_token()}}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body onload='load()' style="background-image: linear-gradient(to right,#cce6ff,#ffb3ff)">
<div class="container">
	<h4 id="wp"></h4>
<br><button id="li" hidden type="button" data-toggle="modal" data-target="#modal" onclick="logBtn()">Login</button>&nbsp<button id="lo" hidden type="button" onclick="logout()">Logout</button><br><br>
	<h4 id="w"></h4>
<div class="modal fade" id="modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="h4">Login</h4>
        </div>
        <div class="modal-body">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" required="">
    </div>
    <div class="form-group">
      <label id="lpass" for="pass">Password:</label>
      <input type="password" class="form-control" id="pass" required="">
    </div>
      <br><input type="submit" id="sub"><br>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <table class="table" hidden>
    <thead>
      <tr>
      	<div class="row">
        	<th class="col-sm-8">Messages</th>
 			<th class="col-sm-4">Friends</th>
    	</div>
      </tr>
    </thead>
    <tbody id="tbody">
      <tr>
        <td class='col-sm-8'><div id="scrl" style="height:350px;width:700px;overflow-y:auto;overflow-x:auto;background-image: linear-gradient(to right,#ffffcc,#ffffcc);"><div style="width:690px" id="msg"></div></div></td> <td id='frnds' class='col-sm-4'></td>
      </tr>
    </tbody>
  </table>

</div>
<audio id="aud">
  <source src="{{asset('audio/stairs.mp3')}}" type="audio/mpeg">
</audio>

<script type="text/javascript">
	

  $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $("meta[name='csrf_token']").attr('content')
		}
	});

//GLOBALS
  var cus='';
  var frnds='';
  var cid='';
  var fid='';
  var preclen='';
  var pfid;
  var acfid;
  var psntlen;
  var myTime=undefined;
  var ldTime=undefined;
//

  logBtn= function(){
		$("#email").val('');
		$("#pass").val('');
	}

  logout= function()
{
    $.ajax({
    url: 'logout',
    type: 'POST',
    success: function(response)
    {
        $("#wp").show();
        $("#w").hide();
        $("#li").show();
        $("#wp").text("Welcome to ChatBox. Please login.");
        $("#li").attr("class","btn btn-success btn-lg").fadeIn();
        $("#lo").hide();
        $("#tbody").hide();
        //if(typeof myTime != 'undefined')
            clearTimeout(myTime);
            clearTimeout(ldTime);
        cid='';
        fid='';
        cus='';
        frnds='';
        pfid='';
        preclen='';
        psntlen='';
    }
  });
}


	$("#sub").click(function(){
		var email=$("#email").val();
		var pass=$("#pass").val();
		$.ajax({
			url: 'login',
			type: 'POST',
			data: {
				email: email,
				pass: pass
			},
			success: function(response){
				$("#modal").modal("hide");
        if(response.msg)
        alert(response.msg);
      else
        {
            user(response);
            myTime=setTimeout(load,5000);
        }
			}
		});
	});


load= function(){
      $.ajax({
        url: 'load',
        type: 'POST',
        success: function(response)
        {
            cus=response.cus;
            frnds=response.frnds;
            user();
            if(cus)
              myTime= setTimeout(load,5000);
            else
            {
                $("#wp").text("Welcome to ChatBox. Please login.");
                $("#li").attr("class","btn btn-success btn-lg").fadeIn();
                $(".table").fadeIn();
            }
            return;
        }
      });
}

user= function(response){
      if(cus)
        var len=frnds.length;
      
      else if(response)
      {  
        frnds=response.frnds;
        cus=response.cus;
        var len=frnds.length;
      }

      else
        return;

          $(".table").fadeIn();
          $("#wp").hide();
          $("#li").hide();
          $("#w").show();
          $("#frnds div").remove();
          $(".tr").remove();
          $("#tbody").show();
          $("#lo").attr("class","btn btn-danger btn-lg").fadeIn();
          $("#w").html("Welcome <b>"+cus.name+"</b>");
          $("#msg").text("Select one of your friends for chatting");
          for(var i=0; i<len; i++)
          {
              $("#frnds").append("<div class='row'><a style='color:blue' id='frnd"+frnds[i].id+"' href='#' onclick='ldmsg("+cus.id+","+frnds[i].id+")'>"+frnds[i].name+"</a></div>");
          }
          $("#tbody").append("<tr class='tr'><td class='col-sm-8'><textarea maxlength='255' rows='4' cols='90'></textarea>&nbsp<button id='snd' hidden type='button' onclick='sndmsg()'>Send</button><input id='file' type='file'></td><td></td></tr>");
      
          return;
      }


      ldmsg= function(cid,fid)
      {
            $("#frnd"+pfid).css('color','blue');
            if(pfid!=fid)
            {
              acfid='';
              preclen='';
              psntlen='';
            }
            pfid=fid;
            $("#frnd"+fid).css('color','green');
            this.cid=cid;
            this.fid=fid;
            $.ajax({
              url: 'ldmsg',
              type: 'POST',
              data: {
                cid: cid,
                fid: fid
              },
              success: function(response){
                
                  clearTimeout(myTime);
                  cid=response.cid;
                  fid=response.fid;
                  var recmsg=response.recmsg;
                  var sntmsg=response.sntmsg;
                  var reclen=recmsg.length;
                  var sntlen=sntmsg.length
                  playAud(reclen);
                  if(sntlen>reclen)
                    var len=sntlen;
                  else
                    var len=reclen;

                  if((acfid==fid && reclen!=preclen) || (acfid==fid && sntlen!=psntlen) || (!acfid || len<=0))
                  {
                      $("#msg").text('');
                      $("#msg div").remove();

                      if(len>0){
                        $("#msg").append("<div class='row'></div><br>");
                        for(var i=0, j=0; j<reclen || i<sntlen;)
                        {
                          if((i<sntlen && reclen<=0) || (i<sntlen && j>=reclen) || (i<sntlen && sntmsg[i].id<recmsg[j].id))
                          {
                              if(sntmsg[i].mssg && sntmsg[i].fileurl)
                              {
                                if(sntmsg[i].ext=="png" || sntmsg[i].ext=="jpg")
                                {
                                  $("#msg").append("<div class='row' style='padding-left:25px'><p class='col-sm-4'><span style='background-color:#009933;border-radius:25px;color:white;padding:6px'>"+sntmsg[i].mssg+"</span><br><br><img src='"+sntmsg[i].fileurl+"' style='height:200px;width:180px'></p><p class='col-sm-4'></p><p class='col-sm-4'></p></div>");
                                }

                                else if(sntmsg[i].ext=="mp4")
                                {
                                  $("#msg").append("<div class='row' style='padding-left:25px'><p class='col-sm-4'><span style='background-color:#009933;border-radius:25px;color:white;padding:6px'>"+sntmsg[i].mssg+"</span><br><br><video width='300px' height='200px' controls><source src='"+sntmsg[i].fileurl+"' type='video/"+sntmsg[i].ext+"'></video></p><p class='col-sm-4'></p><p class='col-sm-4'></p></div>");
                                }

                                else if(sntmsg[i].ext=="mp3")
                                {
                                  $("#msg").append("<div class='row' style='padding-left:25px'><p class='col-sm-4'><span style='background-color:#009933;border-radius:25px;color:white;padding:6px'>"+sntmsg[i].mssg+"</span><br><br><audio controls><source src='"+sntmsg[i].fileurl+"' type='audio/mpeg'></audio></p><p class='col-sm-4'></p><p class='col-sm-4'></p></div>");
                                }
                              }
                              
                              else if(sntmsg[i].mssg && !sntmsg[i].fileurl)
                              {
                                $("#msg").append("<div class='row' style='padding-left:25px'><p class='col-sm-4'><span style='background-color:#009933;border-radius:25px;color:white;padding:6px'>"+sntmsg[i].mssg+"</span></p><p class='col-sm-4'></p><p class='col-sm-4'></p></div>");
                              }

                              else if(!sntmsg[i].mssg && sntmsg[i].fileurl)
                              {
                                if(sntmsg[i].ext=="png" || sntmsg[i].ext=="jpg")
                                {
                                  $("#msg").append("<div class='row' style='padding-left:25px'><p class='col-sm-4'><img src='"+sntmsg[i].fileurl+"' style='height:200px;width:180px'></p><p class='col-sm-4'></p><p class='col-sm-4'></p></div>");
                                }

                                else if(sntmsg[i].ext=="mp4")
                                {
                                  $("#msg").append("<div class='row' style='padding-left:25px'><p class='col-sm-4'><video width='300px' height='200px' controls><source src='"+sntmsg[i].fileurl+"' type='video/"+sntmsg[i].ext+"'></video></p><p class='col-sm-4'></p><p class='col-sm-4'></p></div>");
                                }

                                else if(sntmsg[i].ext=="mp3")
                                {
                                  $("#msg").append("<div class='row' style='padding-left:25px'><p class='col-sm-4'><audio controls><source src='"+sntmsg[i].fileurl+"' type='audio/mpeg'></audio></p><p class='col-sm-4'></p><p class='col-sm-4'></p></div>");
                                }
                              }

                              i++;
                          }

                          if((j<reclen && sntlen<=0) || (j<reclen && i>=sntlen) || (j<reclen && sntmsg[i].id>recmsg[j].id))
                          {
                              if(recmsg[j].mssg && recmsg[j].fileurl)
                              {
                                if(recmsg[j].ext=="png" || recmsg[j].ext=="jpg")
                                {
                                  $("#msg").append("<div class='row'><p class='col-sm-4'></p><p class='col-sm-4'></p><p class='col-sm-4'><span style='background-color:#ff6666;border-radius:25px;color:white;padding:6px'>"+recmsg[j].mssg+"</span><br><br><img src='"+recmsg[j].fileurl+"' style='height:200px;width:180px'></p></div>");
                                }

                                else if(recmsg[j].ext=="mp4")
                                {
                                  $("#msg").append("<div class='row'><p class='col-sm-4'></p><p class='col-sm-4'></p><p class='col-sm-4'><span style='background-color:#ff6666;border-radius:25px;color:white;padding:6px'>"+recmsg[j].mssg+"</span><br><br><video width='300px' height='200px' controls><source src='"+recmsg[j].fileurl+"' type='video/"+recmsg[j].ext+"'></video></p></div>");
                                }

                                else if(recmsg[j].ext=="mp3")
                                {
                                  $("#msg").append("<div class='row'><p class='col-sm-4'></p><p class='col-sm-4'></p><p class='col-sm-4'><span style='background-color:#ff6666;border-radius:25px;color:white;padding:6px'>"+recmsg[j].mssg+"</span><br><br><audio controls><source src='"+recmsg[j].fileurl+"' type='audio/mpeg'></audio></p></div>");
                                }

                              }

                              else if(recmsg[j].mssg && !recmsg[j].fileurl)
                              {
                                $("#msg").append("<div class='row'><p class='col-sm-4'></p><p class='col-sm-4'></p><p class='col-sm-4'><span style='background-color:#ff6666;border-radius:25px;color:white;padding:6px'>"+recmsg[j].mssg+"</span></p></div>");
                              }

                              if(!recmsg[j].mssg && recmsg[j].fileurl)
                              {
                                if(recmsg[j].ext=="png" || recmsg[j].ext=="jpg")
                                {
                                  $("#msg").append("<div class='row'><p class='col-sm-4'></p><p class='col-sm-4'></p><p class='col-sm-4'><img src='"+recmsg[j].fileurl+"' style='height:200px;width:180px'></p></div>");
                                }

                                else if(recmsg[j].ext=="mp4")
                                {
                                  $("#msg").append("<div class='row'><p class='col-sm-4'></p><p class='col-sm-4'></p><p class='col-sm-4'><video width='300px' height='200px' controls><source src='"+recmsg[j].fileurl+"' type='video/"+recmsg[j].ext+"'></video></p></div>");
                                }

                                else if(recmsg[j].ext=="mp3")
                                {
                                  $("#msg").append("<div class='row'><p class='col-sm-4'></p><p class='col-sm-4'></p><p class='col-sm-4'><audio controls><source src='"+recmsg[j].fileurl+"' type='audio/mpeg'></audio></p></div>");
                                }
                              }

                              j++;
                          }
                        }
                          preclen=reclen;
                          psntlen=sntlen;
                      }
                      else
                        $("#msg").text("No messages yet.");

                      acfid=fid;
                      $("#scrl").scrollTop($("#msg").height());
                      $("#snd").attr('class','btn btn-info').fadeIn();
                  }

                  ldTime=setTimeout(setLdTime,3500);
                return;
              }
            });
              
            return;
      }

      playAud= function(reclen)
      {
          if(acfid==fid && reclen>preclen)
          {
              $("#aud")[0].play();
          }
          return;
      }

      setLdTime= function()
      {
          ldmsg(cid,fid);
      }
      
      sndmsg= function()
      {
          clearTimeout(ldTime);
          var mssg=$("textarea").val();
          var file=$("#file")[0].files[0];
          var formData=new FormData();
          formData.append('file',file);
          formData.append('mssg',mssg);
          if(mssg!='' || file)
            $.ajax({
              url: 'sndmsg',
              type: 'POST',
              data: formData,
              processData: false,
              contentType: false,            
              success: function(response)
              {
                  cid=response.cid;
                  fid=response.fid;
                  $("textarea").val('');
                  $("#file").val('');
                  ldmsg(cid,fid);
              }

            });
          else
            alert("Write or upload Something.");

          
      }

</script>
</body>
</html>
